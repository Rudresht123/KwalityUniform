<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use App\Services\InvoiceService;
use Illuminate\Support\Facades\Storage;

class TestAttachmentPath extends Command
{
    protected $signature = 'test:attachment-path {order_id=10}';
    protected $description = 'Check if the PDF path is accessible to the EmailService';

    public function handle()
    {
        $orderId = $this->argument('order_id');
        $order = Order::find($orderId);
        
        if (!$order) {
            $this->error("Order not found.");
            return 1;
        }

        $invoiceService = new InvoiceService();
        $path = $invoiceService->generateInvoice($order);
        
        $this->info("Storage Path: {$path}");
        $fullPath = storage_path('app/' . $path);
        $this->info("Full System Path: {$fullPath}");
        
        if (file_exists($fullPath)) {
            $this->info("✅ file_exists() says YES");
        } else {
            $this->error("❌ file_exists() says NO");
        }

        return 0;
    }
}
