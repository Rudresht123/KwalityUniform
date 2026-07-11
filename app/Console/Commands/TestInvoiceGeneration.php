<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use App\Services\InvoiceService;
use Illuminate\Support\Facades\Storage;

class TestInvoiceGeneration extends Command
{
    protected $signature = 'test:invoice-gen {order_id=10}';
    protected $description = 'Test PDF invoice generation and storage';

    public function handle()
    {
        $orderId = $this->argument('order_id');
        $order = Order::find($orderId);

        if (!$order) {
            $this->error("Order not found.");
            return 1;
        }

        $this->info("Generating invoice for Order: {$order->order_number}");

        try {
            $invoiceService = new InvoiceService();
            $path = $invoiceService->generateInvoice($order);
            
            $this->info("PDF Path: {$path}");
            
            if (Storage::exists($path)) {
                $this->info("✅ PDF successfully saved to storage!");
            } else {
                $this->error("❌ PDF NOT found in storage at: {$path}");
            }
        } catch (\Exception $e) {
            $this->error("Error during generation: " . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
