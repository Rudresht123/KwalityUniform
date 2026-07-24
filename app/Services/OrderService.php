<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\SuperAdmin\ProductVariant;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\SuperAdmin\School;
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
     * Place orders, potentially splitting by vendor.
     *
     * @param Cart $cart
     * @param array $details
     * @return \Illuminate\Support\Collection|Order
     * @throws Exception
     */
    public function placeOrder(Cart $cart, array $details)
    {
        return DB::transaction(function () use ($cart, $details) {
            $lockedCart = Cart::where('cart_id', $cart->cart_id)
                ->lockForUpdate()
                ->first();

            if (!$lockedCart || $lockedCart->status !== 'active') {
                throw new Exception('This order has already been processed or the cart is no longer active.');
            }

            $cartItems = CartItem::where('cart_id', (string)$cart->cart_id)
                ->with(['product', 'variant'])
                ->lockForUpdate()
                ->get();

            if ($cartItems->isEmpty()) {
                throw new Exception('Your basket is empty.');
            }

            $createdOrders = collect();
            $groupedItems = [];

            // 1. Group items by vendor
            foreach ($cartItems as $item) {
                $variant = ProductVariant::where('variant_id', $item->variant_id)->lockForUpdate()->first();
                if (!$variant || !$variant->is_active || !$item->product->is_active) {
                    throw new Exception("Product {$item->product->product_name} is no longer available.");
                }

                // Resolve Vendor
                $school = School::findOrFail($item->product->schoolApprovals->first()?->school_id);
                $activeVendor = $this->catalogService->getActiveVendor($school, $item->product->category);
                $vendorId = $activeVendor?->vendor_id ?? $item->product->vendor_id;

                $groupedItems[$vendorId][] = [
                    'item' => $item,
                    'variant' => $variant,
                    'price' => $variant->selling_price ?? $variant->price ?? 0,
                    'school_id' => $school->school_id
                ];
            }

            // 2. Create separate orders per vendor
            foreach ($groupedItems as $vendorId => $items) {
                $subtotal = collect($items)->sum(fn($i) => $i['price'] * $i['item']->quantity);
                $schoolId = $items[0]['school_id'];
                // Link or create a student record


                $student = \App\Models\Student::firstOrCreate([
                    'school_id' => $schoolId,
                    'user_id' => Auth::id(),
                    'student_name' => $details['student_name'] ?? null,
                    'student_class' => $details['student_class'] ?? null,
                    'student_section' => $details['student_section'] ?? null,
                ]);



                $order = Order::create([
                    'order_number' => generateOrderNumber($school->school_id),
                    'user_id' => Auth::id(),
                    'school_id' => $schoolId,
                    'vendor_id' => $vendorId,
                    'student_id' => $student->id,
                    'cart_id' => $cart->cart_id,
                    'delivery_type' => $details['delivery_type'],
                    'status' => 'pending',
                    'payment_status' => 'pending',
                    'subtotal' => $subtotal,
                    'shipping_charge' => 0,
                    'grand_total' => $subtotal,
                    'placed_at' => now(),
                ]);

                \Log::info('OrderService: Order created with ID:', ['id' => $order->id, 'student_id' => $order->student_id]);

                // Create Order Items
                foreach ($items as $vItem) {
                    $item = $vItem['item'];
                    $variant = $vItem['variant'];
                    $variant->decrement('stock_qty', $item->quantity);

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'variant_id' => $item->variant_id,
                        'vendor_id' => $vendorId,
                        'product_name' => $item->product->product_name,
                        'sku' => $variant->sku,
                        'unit_price' => $vItem['price'],
                        'quantity' => $item->quantity,
                        'line_total' => $vItem['price'] * $item->quantity,
                    ]);
                }

                \App\Jobs\ProcessOrderConfirmation::dispatch($order);
                $createdOrders->push($order);
            }

            CartItem::where('cart_id', $cart->cart_id)->delete();
            $lockedCart->update(['status' => 'completed']);

            return $createdOrders->count() === 1 ? $createdOrders->first() : $createdOrders;
        });
    }
}
