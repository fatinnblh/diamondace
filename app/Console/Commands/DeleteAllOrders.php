<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class DeleteAllOrders extends Command
{
    protected $signature = 'orders:delete-all';
    protected $description = 'Delete all orders and their related files from the system';

    public function handle()
    {
        if (!$this->confirm('Are you sure you want to delete ALL orders? This action cannot be undone!')) {
            $this->info('Operation cancelled.');
            return;
        }

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
            
            $this->info("Successfully deleted {$count} orders and their associated files.");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('An error occurred: ' . $e->getMessage());
        }
    }
}
