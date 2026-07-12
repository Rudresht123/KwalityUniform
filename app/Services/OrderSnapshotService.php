<?php

namespace App\Services;

use App\Models\OrderProductSnapshot;
use App\Models\SuperAdmin\Product;
use App\Models\SuperAdmin\ProductVariant;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Log;
use Throwable;

class OrderSnapshotService
{
    /**
     * Create an immutable snapshot of the product and variant state at the time of order.
     *
     * @param OrderItem $orderItem
     * @param ProductVariant $variant
     * @return OrderProductSnapshot
     * @throws Throwable
     */
    public function createSnapshot(OrderItem $orderItem, ProductVariant $variant): OrderProductSnapshot
    {
        $product = $variant->product;

        // 1. Capture images and thumbnail
        $images = $product->images()->with('file')->get();
        $imageUrls = $images->map(fn($img) => getFileUrl($img->file_id))->toArray();
        $thumbnailUrl = $product->primaryImage ? getFileUrl($product->primaryImage->file_id) : asset("assets/images/no_image.jpg");

        // 2. Handle specifications and brand (not in DB currently, default to null or a placeholder)
        // In a future update, these will be fetched from their respective models/tables.
        $specifications = null; 
        $brandName = null;

        // 3. Capture School information if applicable
        $schoolName = null;
        $schoolApproval = $product->schoolApprovals->first();
        if ($schoolApproval) {
            // Assuming a School model exists and has a name
            // We'll use a generic way to get it or just the ID for now
            $schoolName = 'School ID: ' . $schoolApproval->school_id;
        }

        return OrderProductSnapshot::create([
            'snapshot_id' => \Illuminate\Support\Str::uuid(),
            'order_item_id' => $orderItem->id,
            'product_id' => $product->product_id,
            'vendor_id' => $product->vendor_id,
            
            'category_name' => $product->category->category_name ?? 'N/A',
            'brand_name' => $brandName,
            'product_name' => $product->product_name,
            'description' => $product->description,
            'sku' => $variant->sku,
            'gender' => $product->gender_type,
            'material' => $product->fabric_composition,
            'specifications' => $specifications,
            
            'selling_price' => $variant->selling_price,
            'original_price' => $variant->mrp,
            'discount_amount' => $variant->mrp - $variant->selling_price,
            'tax_amount' => 0, // Tax calculation logic should be placed here if available
            
            'size_name' => $variant->size->display_name ?? $variant->size->size_name ?? 'N/A',
            'color_name' => $variant->color->color_name ?? 'N/A',
            'variant_details' => [
                'variant_id' => $variant->variant_id,
                'barcode' => $variant->barcode,
            ],
            
            'thumbnail_url' => $thumbnailUrl,
            'image_urls' => $imageUrls,
            'school_name' => $schoolName,
            'delivery_info' => [], 
        ]);
    }
}
