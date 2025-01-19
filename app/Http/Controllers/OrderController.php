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
       $baseCost = $pageCount * 0.10;
   
       // Create a new order record and store it in a variable
       $order = Order::create([
           'file_path' => $filePath,
           'paper_size' => $request->paper_size,
           'binding_style' => $request->binding_style,
           'cover_colour' => $request->cover_colour,
           'quantity' => $request->quantity,
           'page_count' => $pageCount,
           'base_cost' => $baseCost,
           'shipping_option' => $request->shipping_option, 
           'payment_method' => $request->payment_method, 
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
       $baseCost = 0;
   
       if ($request->file('thesis_file')->getClientOriginalExtension() === 'pdf') {
           $pdfParser = new PdfParser();
           $pdf = $pdfParser->parseFile($request->file('thesis_file')->getRealPath());
           $pageCount = count($pdf->getPages());
       } elseif ($request->file('thesis_file')->getClientOriginalExtension() === 'docx') {
           $phpWord = WordIOFactory::load($request->file('thesis_file')->getRealPath());
           $pageCount = count($phpWord->getSections());
       }
   
       // Calculate base cost
       $baseCost = $pageCount * 0.10; // RM0.10 per page
   
       return response()->json([
           'page_count' => $pageCount,
           'base_cost' => $baseCost,
       ]);
   }

   public function summary($id)
   {
       // Fetch the order details from the database using the ID
       $order = Order::findOrFail($id); // This will throw a 404 if the order is not found
   
       // Return the summary view with the order data
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
}