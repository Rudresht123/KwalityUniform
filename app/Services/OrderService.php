<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\SuperAdmin\ProductVariant;
use App\Models\Cart;
use App\Models\CartItem;
use App\Services\CatalogService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Exception;
use Throwable;

class OrderService
{
    protected CatalogService $catalogService;

    public function __construct(CatalogService $catalogService)
    {
        $this->catalogService = $catalogService;
    }

    /**
     * Place an order with strict inventory reservation and validation.
     *
     * @param Cart $cart
     * @param array $details
     * @return Order
     * @throws Exception
     */
    public function placeOrder(Cart $cart, array $details): Order
    {
        return DB::transaction(function () use ($cart, $details) {
            // 1. Lock and Validate Cart Status to prevent duplicate orders (Idempotency)
            $lockedCart = Cart::where('cart_id', $cart->cart_id)
                ->lockForUpdate()
                ->first();

            if (!$lockedCart || $lockedCart->status !== 'active') {
                throw new Exception('This order has already been processed or the cart is no longer active.');
            }

            // Mark cart as completed immediately to block concurrent requests
            $lockedCart->update(['status' => 'completed']);

            $cartItems = CartItem::where('cart_id', (string)$cart->cart_id)
                ->with(['product', 'variant'])
                ->lockForUpdate()
                ->get();

            if ($cartItems->isEmpty()) {
                throw new Exception('Your basket is empty. Please add items to your cart before checking out.');
            }

            // 2. Final Stock, Status & Price Validation
            $validatedItems = [];
            $detectedSchoolId = null;
            $detectedVendorId = null;

            foreach ($cartItems as $item) {
                $variant = ProductVariant::where('variant_id', $item->variant_id)
                    ->lockForUpdate()
                    ->first();

                if (!$variant || !$variant->is_active) {
                    throw new Exception("The variant for product {$item->product->product_name} is no longer available.");
                }

                if (!$item->product->is_active) {
                    throw new Exception("Product {$item->product->product_name} is no longer available.");
                }

                // Price Consistency Check
                $currentPrice = $variant->selling_price ?? $variant->price ?? 0;
                if (abs($item->unit_price - $currentPrice) > 0.01) {
                    throw new Exception("The price for {$item->product->product_name} has changed. Please update your cart and try again.");
                }

                if ($variant->stock_qty < $item->quantity) {
                    $sizeName = $variant->size->display_name ?? $variant->size->size_name ?? 'N/A';
                    $colorName = $variant->color->color_name ?? 'N/A';
                    throw new Exception("Insufficient stock for {$item->product->product_name} ({$sizeName} / {$colorName}). Only {$variant->stock_qty} left.");
                }

                // Capture school_id
                if (!$detectedSchoolId) {
                    $detectedSchoolId = $item->product->schoolApprovals->first()?->school_id;
                }

                // Resolve Vendor for this category
                $activeVendor = $this->catalogService->getActiveVendor(
                    \App\Models\School::findOrFail($detectedSchoolId),
                    $item->product->category
                );

                if (!$detectedVendorId) {
                    $detectedVendorId = $activeVendor->vendor_id;
                } elseif ($detectedVendorId !== $activeVendor->vendor_id) {
                    throw new Exception("All items in an order must belong to the same active vendor: {$activeVendor->business_name}.");
                }

                $validatedItems[] = [
                    'variant' => $variant,
                    'item' => $item,
                    'price' => $currentPrice,
                    'vendor_id' => $activeVendor->vendor_id,
                ];
            }

            // 3. Calculate Totals
            $subtotal = 0;
            foreach ($validatedItems as $vItem) {
                $subtotal += $vItem['price'] * $vItem['item']->quantity;
            }

            $shipping = 0;
            $grandTotal = $subtotal + $shipping;

            // 4. Create Order with School and Vendor Attribution
            $order = Order::create([
                'order_number' => 'ORD-' . strtoupper(Str::random(10)),
                'user_id' => Auth::id(),
                'school_id' => $detectedSchoolId,
                'vendor_id' => $detectedVendorId, // Automatically determined
                'student_name' => $details['student_name'] ?? null,
                'student_class' => $details['student_class'] ?? null,
                'student_section' => $details['student_section'] ?? null,
                'cart_id' => $cart->cart_id,
                'delivery_type' => $details['delivery_type'],
                'status' => 'pending',
                'payment_status' => 'pending',
                'subtotal' => $subtotal,
                'shipping_charge' => $shipping,
                'grand_total' => $grandTotal,
                'placed_at' => now(),
            ]);

            // Save Shipping Address details from checkout
            \App\Models\OrderAddress::create([
                'order_id' => $order->id,
                'type' => 'shipping',
                'full_name' => $details['full_name'] ?? 'N/A',
                'phone' => $details['phone'] ?? 'N/A',
                'email' => $details['email'] ?? 'N/A',
                'address_line1' => $details['address'] ?? 'N/A',
                'city' => $details['city'] ?? 'N/A',
                'state' => $details['state'] ?? 'N/A',
                'postal_code' => $details['zip'] ?? $details['postal_code'] ?? 'N/A',
                'country' => $details['country'] ?? 'India',
            ]);

            // 5. Create Order Items & Deduct Stock
            foreach ($validatedItems as $vItem) {
                $variant = $vItem['variant'];
                $item = $vItem['item'];

                $variant->decrement('stock_qty', $item->quantity);

                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'variant_id' => $item->variant_id,
                    'vendor_id' => $vItem['vendor_id'], // Explicitly use vendor from active partnership
                    'product_name' => $item->product->product_name,
                    'sku' => $variant->sku,
                    'unit_price' => $vItem['price'],
                    'quantity' => $item->quantity,
                    'line_total' => $vItem['price'] * $item->quantity,
                ]);

                // Create a snapshot of the product state at the time of purchase
                app(\App\Services\OrderSnapshotService::class)->createSnapshot($orderItem, $variant);
            }

            // 6. Trigger confirmation emails WITHIN the transaction
            // If this fails, the order won't be created and cart won't be cleared
            app(\App\Observers\OrderObserver::class)->sendOrderConfirmationEmails($order);

            // 7. Clear Cart Items and mark cart as completed only after everything succeeds
            CartItem::where('cart_id', $cart->cart_id)->delete();
            $lockedCart->update(['status' => 'completed']);

            return $order;
        });
    }
}
