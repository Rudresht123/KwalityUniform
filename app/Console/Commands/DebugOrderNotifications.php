<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\OrderItem;
use App\Models\SuperAdmin\Vendor;
use App\Models\SuperAdmin\SchoolProductApproval;
use App\Models\SuperAdmin\School;

class DebugOrderNotifications extends Command
{
    protected $signature = 'test:debug-notifications {order_id=10}';
    protected $description = 'Debug vendor and school notification data for an order';

    public function handle()
    {
        $orderId = $this->argument('order_id');
        $this->info("Debugging Notifications for Order ID: {$orderId}");

        $items = OrderItem::where('order_id', $orderId)->get();
        if ($items->isEmpty()) {
            $this->error("No items found for order ID {$orderId}");
            return 1;
        }

        $this->info("Found {$items->count()} items.");

        foreach ($items as $item) {
            $this->line("--------------------------------------------------");
            $this->info("Item: {$item->product_name} (Product ID: {$item->product_id})");
            
            // Vendor Check
            $vendor = Vendor::find($item->vendor_id);
            if ($vendor) {
                $this->info("Vendor Found: {$vendor->vendor_name} ({$vendor->email})");
            } else {
                $this->error("Vendor NOT found for ID: {$item->vendor_id}");
            }

            // School Approvals Check
            $approvals = SchoolProductApproval::where('product_id', $item->product_id)->get();
            $this->info("School Approvals Found: {$approvals->count()}");
            foreach ($approvals as $app) {
                $school = School::find($app->school_id);
                if ($school) {
                    $this->info(" - School Found: {$school->school_name} ({$school->email})");
                } else {
                    $this->error(" - School NOT found for ID: {$app->school_id}");
                }
            }
        }

        return 0;
    }
}
