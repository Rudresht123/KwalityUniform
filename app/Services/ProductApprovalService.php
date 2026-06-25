<?php

namespace App\Services;

use App\Models\SuperAdmin\Product;
use App\Models\SuperAdmin\ProductApprovalHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ProductStatusUpdatedNotification;
use Illuminate\Support\Facades\Notification;
use App\Services\EmailService;

class ProductApprovalService
{
    /**
     * Approve a product or multiple products.
     *
     * @param Product|array $products
     * @return void
     * @throws \Throwable
     */
    public function approve($products): void
    {
        if ($products instanceof Product) {
            $this->processApproval($products);
            return;
        }

        if (is_array($products)) {
            DB::beginTransaction();
            try {
                foreach ($products as $productId) {
                    $product = Product::findOrFail($productId);
                    $this->processApproval($product);
                }
                DB::commit();
            } catch (\Throwable $e) {
                DB::rollBack();
                throw $e;
            }
            return;
        }

        throw new \InvalidArgumentException('Products must be a Product instance or an array of IDs.');
    }

    /**
     * Reject a product or multiple products.
     *
     * @param Product|array $products
     * @param string $reason
     * @return void
     * @throws \Throwable
     */
    public function reject($products, string $reason): void
    {
        if ($products instanceof Product) {
            $this->processRejection($products, $reason);
            return;
        }

        if (is_array($products)) {
            DB::beginTransaction();
            try {
                foreach ($products as $productId) {
                    $product = Product::findOrFail($productId);
                    $this->processRejection($product, $reason);
                }
                DB::commit();
            } catch (\Throwable $e) {
                DB::rollBack();
                throw $e;
            }
            return;
        }

        throw new \InvalidArgumentException('Products must be a Product instance or an array of IDs.');
    }

    /**
     * Internal method to handle a single product approval.
     */
    protected function processApproval(Product $product): void
    {
        $oldStatus = $product->approval_status;

        $product->update([
            'approval_status' => 'approved',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
            'rejected_by' => null,
            'rejected_at' => null,
            'rejection_reason' => null,
        ]);

        $this->logHistory($product, 'approved', $oldStatus, 'approved', 'Product approved by administrator.');
        $this->notifyVendor($product, 'approved');
    }

    /**
     * Internal method to handle a single product rejection.
     */
    protected function processRejection(Product $product, string $reason): void
    {
        $oldStatus = $product->approval_status;

        $product->update([
            'approval_status' => 'rejected',
            'rejected_by' => Auth::id(),
            'rejected_at' => now(),
            'approved_by' => null,
            'approved_at' => null,
            'rejection_reason' => $reason,
        ]);

        $this->logHistory($product, 'rejected', $oldStatus, 'rejected', $reason);
        $this->notifyVendor($product, 'rejected', $reason);
    }

    /**
     * Mark a product as pending (used when a vendor resubmits).
     *
     * @param Product $product
     * @param string $remarks
     * @return void
     * @throws \Throwable
     */
    public function resubmit(Product $product, string $remarks = 'Product updated and resubmitted for approval.'): void
    {
        DB::beginTransaction();
        try {
            $oldStatus = $product->approval_status;

            $product->update([
                'approval_status' => 'pending',
                'approved_by' => null,
                'approved_at' => null,
                'rejected_by' => null,
                'rejected_at' => null,
                'rejection_reason' => null,
            ]);

            $this->logHistory($product, 'resubmitted', $oldStatus, 'pending', $remarks);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Log the approval action to the history table.
     *
     * @param Product $product
     * @param string $actionType
     * @param string|null $oldStatus
     * @param string $newStatus
     * @param string|null $remarks
     * @return void
     */
    protected function logHistory(Product $product, string $actionType, ?string $oldStatus, string $newStatus, ?string $remarks): void
    {
        ProductApprovalHistory::create([
            'product_id' => $product->product_id,
            'action_type' => $actionType,
            'old_status' => $oldStatus,
            'new_status' => $newStatus,
            'remarks' => $remarks,
            'performed_by' => Auth::id(),
        ]);
    }

    /**
     * Notify the vendor about the status change.
     *
     * @param Product $product
     * @param string $status
     * @param string|null $reason
     * @return void
     */
    protected function notifyVendor(Product $product, string $status, ?string $reason = null): void
    {
        $vendorUser = $product->vendor?->user;
        if (!$vendorUser) return;

        // 1. System Notification
        $notificationKey = ($status === 'approved') ? 'product_approved' : 'product_status_updated';
        
        // We can use the existing helper from helpers.php if we want, 
        // but let's be explicit here for the service.
        $placeholders = [
            'product_name' => $product->product_name,
            'vendor_name' => $product->vendor->owner_name,
            'status' => strtoupper($status),
            'admin_message' => $reason ?? 'Your product status has been updated.',
        ];

        // Using the provided SystemNotification and template system
        // We assume 'product_approved' and 'product_status_updated' exist in notification_templates
        try {
            sendNotification($vendorUser, $notificationKey, $placeholders, route('product.show', $product->product_id));
        } catch (\Throwable $e) {
            // Log notification failure but don't fail the whole transaction
            \Illuminate\Support\Facades\Log::error("Notification failed for product {$product->product_id}: " . $e->getMessage());
        }

        // 2. Branded Email via EmailService
        try {
            EmailService::send('product_status_updated', $vendorUser->email, [
                'vendor_name' => $product->vendor->owner_name,
                'product_name' => $product->product_name,
                'product_code' => $product->product_code,
                'status' => strtoupper($status),
                'admin_message' => $reason ?? 'Your product status has been updated by the administration.',
                'view_button' => '<a href="' . route('product.show', $product->product_id) . '" style="background-color: #6B62DD; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">View Product</a>',
            ]);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error("Email failed for product {$product->product_id}: " . $e->getMessage());
        }
    }
}
