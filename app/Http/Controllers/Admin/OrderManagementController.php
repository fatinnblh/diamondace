<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class OrderManagementController extends Controller
{
    public function deleteAllOrders()
    {
        DB::beginTransaction();
        try {
            // Get all orders that have files
            $orders = Order::whereNotNull('file_path')->get();
            
            // Delete associated files
            foreach ($orders as $order) {
                // Delete order file
                if ($order->file_path && Storage::exists($order->file_path)) {
                    Storage::delete($order->file_path);
                }
                
                // Delete receipt if exists
                if ($order->receipt_path && Storage::exists($order->receipt_path)) {
                    Storage::delete($order->receipt_path);
                }
            }

            // Delete all orders from database
            $count = Order::count();
            Order::truncate();
            
            DB::commit();
            
            return redirect()->back()->with('success', "Successfully deleted {$count} orders and their associated files.");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while deleting orders: ' . $e->getMessage());
        }
    }
}
