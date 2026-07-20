<?php

namespace App\Jobs;

use App\Models\Order;
use App\Observers\OrderObserver;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ProcessOrderConfirmation implements ShouldQueue
{
    use Queueable;

    protected $order;

    /**
     * Create a new job instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $observer = new OrderObserver();
            $observer->sendOrderConfirmationEmails($this->order);
            
            // Notify Vendor
            if ($this->order->vendor) {
                $this->order->vendor->notify(new \App\Notifications\VendorOrderNotification($this->order));
            }
        } catch (\Exception $e) {
            Log::error('Failed to process order confirmation/vendor notification in background: ' . $e->getMessage());
            throw $e;
        }
    }
}
