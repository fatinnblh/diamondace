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

    public function updatePaymentStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $status = $request->input('payment_status');

        if ($status === 'incomplete') {
            // Update order status to awaiting payment
            $order->status = Order::STATUS_AWAITING_PAYMENT;
            $order->save();

            // Notify user about incomplete payment
            $order->user->notify(new PaymentIncompleteNotification($order));

            return redirect()->back()->with('success', 'Payment marked as incomplete. User has been notified.');
        }

        if ($status === 'verified') {
            // Update order status to payment verified
            $order->status = Order::STATUS_PAYMENT_VERIFIED;
            $order->save();

            // Notify user about payment verification
            $order->user->notify(new OrderStatusChangedNotification($order));

            return redirect()->back()->with('success', 'Payment has been verified successfully.');
        }

        return redirect()->back()->with('error', 'Invalid status update request.');
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $status = $request->input('status');

        if ($status === 'printing_in_progress') {
            $order->status = Order::STATUS_PRINTING;
            $order->save();

            // Notify user about order status change
            $order->user->notify(new OrderStatusChangedNotification($order));

            return redirect()->back()->with('success', 'Order status updated to Printing in Progress.');
        }

        if ($status === 'ready') {
            $order->status = Order::STATUS_READY;
            $order->save();

            // Notify user that order is ready
            $order->user->notify(new OrderStatusChangedNotification($order));

            return redirect()->back()->with('success', 'Order is marked as Ready for ' . 
                ($order->shipping_option === 'pickup' ? 'Pick Up' : 'Delivery'));
        }

        return redirect()->back()->with('error', 'Invalid status update request.');
    }
}
