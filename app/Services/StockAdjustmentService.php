<?php

namespace App\Services;

use App\Models\SuperAdmin\ProductVariant;
use App\Models\SuperAdmin\StockAdjustment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Notifications\SystemNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\User;

class StockAdjustmentService
{
    /**
     * Adjust the stock for a specific variant.
     *
     * @param string $variantId
     * @param int $quantity
     * @param string|null $remarks
     * @return ProductVariant
     * @throws \Throwable
     */
    public function adjustStock(string $variantId, int $quantity, ?string $remarks = null): ProductVariant
    {
        return DB::transaction(function () use ($variantId, $quantity, $remarks) {
            // Lock the row to prevent race conditions during concurrent updates
            $variant = ProductVariant::where('variant_id', $variantId)->lockForUpdate()->firstOrFail();
            
            $oldStock = $variant->stock_qty;
            $newStock = $oldStock + $quantity;

            if ($newStock < 0) {
                throw new \InvalidArgumentException("Stock cannot be negative. Current stock: {$oldStock}, Adjustment: {$quantity}");
            }

            // 1. Update Variant Stock
            $variant->update([
                'stock_qty' => $newStock,
            ]);

            // 2. Log Adjustment History
            StockAdjustment::create([
                'variant_id' => $variant->variant_id,
                'old_stock' => $oldStock,
                'added_quantity' => $quantity,
                'new_stock' => $newStock,
                'remarks' => $remarks,
                'created_by' => Auth::id(),
            ]);

            // 3. Handle Low Stock Notification
            $this->handleLowStockNotification($variant);

            return $variant;
        });
    }

    /**
     * Check and trigger low stock notification if threshold is breached.
     *
     * @param ProductVariant $variant
     * @return void
     */
    protected function handleLowStockNotification(ProductVariant $variant): void
    {
        // Condition: Current stock <= alert threshold AND not already notified for this drop
        if ($variant->stock_qty <= $variant->low_stock_alert && is_null($variant->low_stock_notified_at)) {
            
            // Notify Super Admin and users with stock_view permission
            $recipients = User::role('super-admin')
                ->orWhereHas('permissions', function($q) {
                    $q->where('name', 'stock_view');
                })
                ->get();

            if ($recipients->isNotEmpty()) {
                $message = "Variant {$variant->sku} is running low on stock. Current: {$variant->stock_qty}, Threshold: {$variant->low_stock_alert}";
                
                // Using a simple system notification
                Notification::send($recipients, new SystemNotification([
                    'title' => 'Low Stock Alert',
                    'message' => $message,
                    'type' => 'warning',
                    'icon' => 'ti-alert-triangle',
                    'url' => route('product.show', $variant->product_id),
                ], ['database', 'broadcast']));
            }

            // Mark as notified
            $variant->update(['low_stock_notified_at' => now()]);
        } 
        // Reset notification flag if stock is refilled above threshold
        elseif ($variant->stock_qty > $variant->low_stock_alert && !is_null($variant->low_stock_notified_at)) {
            $variant->update(['low_stock_notified_at' => null]);
        }
    }
}
