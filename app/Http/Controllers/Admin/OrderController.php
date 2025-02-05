<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Notifications\OrderStatusChangedNotification;
use App\Notifications\PaymentIncompleteNotification;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.orders', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('user')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'file_path' => 'required',
            'paper_size' => 'required',
            'binding_style' => 'required',
            'cover_colour' => 'required',
            'quantity' => 'required|numeric|min:1',
            'page_count' => 'required|numeric|min:1',
            'base_cost' => 'required|numeric|min:0',
            'shipping_option' => 'required|in:pickup,delivery',
            'payment_method' => 'required|in:qr_code,cash',
        ]);

        $order = Order::create($validatedData);

        return redirect()->route('admin.orders.show', $order->id)
            ->with('success', 'Order created successfully.');
    }

    public function updatePaymentStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $status = $request->input('payment_status');

        if ($status === 'incomplete') {
            // Update order status to awaiting payment
            $order->status = Order::STATUS_AWAITING_PAYMENT;
            $order->payment_message = 'Your payment is incomplete. Please contact us to pay';
            $order->save();

            return redirect()->back()->with('success', 'Payment marked as incomplete. Message has been sent to user.');
        }

        if ($status === 'verified') {
            // Update order status to payment verified
            $order->status = Order::STATUS_PAYMENT_VERIFIED;
            $order->payment_message = null; // Clear any payment message
            $order->save();

            return redirect()->back()->with('success', 'Payment has been verified successfully.');
        }

        return redirect()->back()->with('error', 'Invalid payment status.');
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $status = $request->input('status');

        if ($status === 'printing') {
            $order->status = Order::STATUS_PRINTING;
            $order->save();
            return redirect()->back()->with('success', 'Order status updated to Printing.');
        }

        if ($status === 'ready') {
            // Set status based on shipping option
            if ($order->shipping_option === 'pickup') {
                $order->status = Order::STATUS_READY_PICKUP;
                $message = 'Order is Ready for Pickup';
            } else {
                $order->status = Order::STATUS_READY_DELIVERY;
                $message = 'Order is Ready for Delivery';
            }
            $order->save();
            return redirect()->back()->with('success', $message);
        }

        return redirect()->back()->with('error', 'Invalid status update request.');
    }
}
