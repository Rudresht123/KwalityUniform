<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use App\Observers\OrderObserver;

class ResendOrderEmail extends Command
{
    protected $signature = 'test:resend-order-email {order_id? : The ID of the order to resend email for}';
    protected $description = 'Resend the confirmation email and invoice for an existing order';

    public function handle()
    {
        $orderId = $this->argument('order_id');
        
        if ($orderId) {
            $order = Order::find($orderId);
        } else {
            $order = Order::latest()->first();
        }

        if (!$order) {
            $this->error('Order not found.');
            return 1;
        }

        $this->info("Resending confirmation emails for Order: {$order->order_number} (ID: {$order->id})");

        try {
            app(OrderObserver::class)->sendOrderConfirmationEmails($order);
            $this->info("Confirmation emails triggered successfully!");
        } catch (\Exception $e) {
            $this->error("Error: " . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
