<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; // Make sure to import the Order model
use Illuminate\Support\Facades\Validator;
use Smalot\PdfParser\Parser as PdfParser;
use PhpOffice\PhpWord\IOFactory as WordIOFactory;

class OrderController extends Controller
{
    public function create()
    {
        return view('orders.create'); // Return the order form view
    }

   
   public function store(Request $request)
   {
       \Log::info($request->all());
       // Validate the request
       $validator = Validator::make($request->all(), [
           'thesis_file' => 'required|file|mimes:pdf,docx|max:20480',
           'paper_size' => 'required|string',
           'binding_style' => 'required|string',
           'cover_colour' => 'required|string',
           'quantity' => 'required|integer|min:1',
           'shipping_option' => 'required|string',
           'payment_method' => 'required|string',
           'print_color' => 'required|string|in:bw,color',
       ]);
   
       if ($validator->fails()) {
           return redirect()->back()->withErrors($validator)->withInput();
       }
   
       // Handle file upload
       $filePath = $request->file('thesis_file')->store('thesis_files', 'public');
   
       // Count pages and calculate cost
       $pageCount = 0;
       $baseCost = 0;
   
       if ($request->file('thesis_file')->getClientOriginalExtension() === 'pdf') {
           $pdfParser = new PdfParser();
           $pdf = $pdfParser->parseFile(storage_path('app/public/' . $filePath));
           $pageCount = count($pdf->getPages());
       } elseif ($request->file('thesis_file')->getClientOriginalExtension() === 'docx') {
           $phpWord = WordIOFactory::load(storage_path('app/public/' . $filePath));
           $pageCount = count($phpWord->getSections());
       }
   
       // Calculate base cost
       $costPerPage = $request->print_color === 'color' ? 0.50 : 0.10;
       $baseCost = $pageCount * $costPerPage;
   
       // Create a new order record and store it in a variable
       $order = Order::create([
           'user_id' => auth()->id(),
           'file_path' => $filePath,
           'paper_size' => $request->paper_size,
           'binding_style' => $request->binding_style,
           'cover_colour' => $request->cover_colour,
           'quantity' => $request->quantity,
           'page_count' => $pageCount,
           'base_cost' => $baseCost,
           'shipping_option' => $request->shipping_option, 
           'payment_method' => $request->payment_method, 
           'print_color' => $request->print_color,
       ]);
   
       // Redirect to the summary page using the newly created order's ID
       return redirect()->route('orders.summary', ['id' => $order->id])->with('success', 'Order placed successfully!');
   }

   public function getPageCount(Request $request)
   {
       // Validate the file
       $request->validate([
           'thesis_file' => 'required|file|mimes:pdf,docx|max:20480',
       ]);
   
       // Handle file upload and count pages
       $pageCount = 0;
   
       if ($request->file('thesis_file')->getClientOriginalExtension() === 'pdf') {
           $pdfParser = new PdfParser();
           $pdf = $pdfParser->parseFile($request->file('thesis_file')->getRealPath());
           $pageCount = count($pdf->getPages());
       } elseif ($request->file('thesis_file')->getClientOriginalExtension() === 'docx') {
           $phpWord = WordIOFactory::load($request->file('thesis_file')->getRealPath());
           $pageCount = count($phpWord->getSections());
       }
   
       return response()->json([
           'page_count' => $pageCount,
       ]);
   }

   public function summary($id)
   {
       $order = Order::findOrFail($id);
       $order->file_url = asset('storage/' . $order->file_path);
        
       return view('orders.summary', compact('order'));
   }

   public function showDeliveryAddressForm($order_id)
   {
       $order = Order::findOrFail($order_id);
       return view('orders.delivery_address', compact('order'));
   }

   public function showPickupAddressForm($order_id)
   {
       $order = Order::findOrFail($order_id);
       return view('orders.pickup_address', compact('order'));
   }

   public function handlePaymentMethod(Request $request, $order_id)
   {
       // Validate the request
       $request->validate([
           'receipt_upload' => 'nullable|file|mimes:jpg,png,pdf|max:2048', // Adjust as needed
       ]);

       // Retrieve the order
       $order = Order::findOrFail($order_id);

       // Handle QR code payment
       if ($order->payment_method == 'qr_code') {
           if ($request->hasFile('receipt_upload')) {
               // Handle the receipt upload
               $filePath = $request->file('receipt_upload')->store('receipts', 'public');
               // You may want to save the file path to the order or perform other actions
           }
           // Redirect to a confirmation page or display a success message
           return redirect()->route('orders.confirmation', ['order_id' => $order_id])->with('success', 'Payment processed successfully!');
       }

       // Handle other payment methods (e.g., FPX) here

       return redirect()->route('orders.summary', ['id' => $order_id])->with('error', 'Invalid payment method.');
   }

   public function uploadReceipt(Request $request, $order_id)
    {
        $request->validate([
            'receipt_upload' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $order = Order::findOrFail($order_id);

        if ($request->hasFile('receipt_upload')) {
            $receiptPath = $request->file('receipt_upload')->store('receipts', 'public');
            $order->update(['receipt_path' => $receiptPath]);
        }

        if ($order->shipping_option == 'delivery') {
            return redirect()->route('delivery.address.form', ['order_id' => $order->id]);
        } else {
            return redirect()->route('pickup.address.form', ['order_id' => $order->id]);
        }
    }

    public function showTrackingProgress($order_id)
    {
        $order = Order::findOrFail($order_id);
        return view('orders.tracking', compact('order'));
    }

    public function handleDeliveryAddress(Request $request, $order_id)
    {
        $request->validate([
            'address' => 'required|string',
            'city' => 'required|string',
            'postcode' => 'required|string',
        ]);

        $order = Order::findOrFail($order_id);
        $order->update([
            'delivery_address' => $request->address,
            'delivery_city' => $request->city,
            'delivery_postcode' => $request->postcode,
            'status' => $order->payment_method === 'qr_code' ? Order::STATUS_AWAITING_PAYMENT : Order::STATUS_PAYMENT_VERIFIED
        ]);

        return redirect()->route('orders.tracking', ['order_id' => $order->id]);
    }

    public function handlePickupAddress(Request $request, $order_id)
    {
        $order = Order::findOrFail($order_id);
        $order->update([
            'status' => $order->payment_method === 'qr_code' ? Order::STATUS_AWAITING_PAYMENT : Order::STATUS_PAYMENT_VERIFIED
        ]);

        return redirect()->route('orders.tracking', ['order_id' => $order->id]);
    }

    public function uploadReceiptUpdated(Request $request, $order_id)
    {
        $request->validate([
            'receipt_upload' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $order = Order::findOrFail($order_id);

        if ($request->hasFile('receipt_upload')) {
            $receiptPath = $request->file('receipt_upload')->store('receipts', 'public');
            $order->update([
                'receipt_path' => $receiptPath,
                'status' => Order::STATUS_PAYMENT_VERIFIED
            ]);
        }

        return redirect()->route('orders.tracking', ['order_id' => $order->id]);
    }

   public function adminIndex()
    {
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function adminShow($order_id)
    {
        $order = Order::findOrFail($order_id);
        return view('admin.orders.show', compact('order'));
    }

    public function updateOrderStatus(Request $request, $order_id)
    {
        $request->validate([
            'status' => 'required|string|in:printing_in_progress,ready'
        ]);

        $order = Order::findOrFail($order_id);
        $order->update(['status' => $request->status]);

        return response()->json(['success' => true]);
    }
}