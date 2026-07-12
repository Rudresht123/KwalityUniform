<?php

use App\Models\User;
use App\Models\SuperAdmin\Vendor;
use App\Models\SuperAdmin\Category;
use App\Models\SuperAdmin\Product;
use App\Models\SuperAdmin\ProductVariant;
use App\Models\Cart;
use App\Models\CartItem;
use App\Services\OrderService;
use App\Models\OrderItem;
use App\Models\OrderProductSnapshot;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

echo "Starting Verification Test...
";

// 1. Setup Environment
try {
    // Create a User
    $user = User::first() ?? User::factory()->create(['name' => 'Test Customer', 'email' => 'customer@test.com']);
    Auth::login($user);
    echo "User: {$user->email}
";

    // Create a Vendor
    $vendor = Vendor::first() ?? Vendor::create([
        'vendor_id' => Str::uuid(),
        'user_id' => $user->id,
        'business_name' => 'Test Vendor',
        'owner_name' => 'Owner',
        'email' => 'vendor@test.com',
        'phone' => '1234567890',
        'address' => '123 Test St',
        'city' => 'Test City',
        'state' => 'Test State',
        'zip' => '123456',
        'pincode' => '123456',
        'country' => 'India',
    ]);
    echo "Vendor: {$vendor->business_name}
";

    // Create a Category
    $category = Category::first() ?? Category::create([
        'category_id' => Str::uuid(),
        'category_name' => 'Uniforms',
        'is_active' => true,
    ]);
    echo "Category: {$category->category_name}
";

    // Create a Product
    $product = Product::create([
        'product_id' => Str::uuid(),
        'vendor_id' => $vendor->vendor_id,
        'category_id' => $category->category_id,
        'product_code' => 'PROD-' . Str::random(5),
        'product_name' => 'Original School Shirt',
        'slug' => 'original-school-shirt-' . Str::random(5),
        'description' => 'A high quality school shirt',
        'gender_type' => 'unisex',
        'approval_status' => 'approved',
        'is_active' => true,
        'created_by' => $user->id,
        'updated_by' => $user->id,
    ]);
    echo "Product: {$product->product_name}
";

    // Create a Variant
    $variant = ProductVariant::create([
        'variant_id' => Str::uuid(),
        'product_id' => $product->product_id,
        'sku' => 'SKU-' . Str::random(5),
        'mrp' => 100.00,
        'selling_price' => 80.00,
        'stock_qty' => 100,
        'is_active' => true,
        'created_by' => $user->id,
        'updated_by' => $user->id,
    ]);
    echo "Variant Price: {$variant->selling_price}
";

    // 2. Place Order
    $cart = Cart::create([
        'cart_id' => Str::uuid(),
        'user_id' => $user->id,
        'status' => 'active',
    ]);

    CartItem::create([
        'cart_item_id' => Str::uuid(),
        'cart_id' => $cart->cart_id,
        'product_id' => $product->product_id,
        'variant_id' => $variant->variant_id,
        'vendor_id' => $vendor->vendor_id,
        'quantity' => 2,
        'unit_price' => 80.00,
    ]);

    $details = [
        'delivery_type' => 'home',
        'full_name' => 'Test Customer',
        'phone' => '1234567890',
        'email' => 'customer@test.com',
        'address' => '123 Test St',
        'city' => 'Test City',
        'state' => 'Test State',
        'zip' => '123456',
        'country' => 'India',
    ];

    $orderService = new OrderService();
    $order = $orderService->placeOrder($cart, $details);
    echo "Order Created: {$order->order_number}
";

    // 3. Verify Snapshot
    $orderItem = OrderItem::where('order_id', $order->id)->first();
    $snapshot = OrderProductSnapshot::where('order_item_id', $orderItem->id)->first();

    if (!$snapshot) {
        throw new Exception("FAILED: No snapshot found for order item!");
    }
    echo "Snapshot verified! Product Name in Snapshot: {$snapshot->product_name}, Price: {$snapshot->selling_price}
";

    // 4. Vendor updates product price
    echo "Vendor is updating product price from 80.00 to 120.00...
";
    $variant->update(['selling_price' => 120.00]);
    $product->update(['product_name' => 'Updated School Shirt Name']);

    // 5. Verify Order and Snapshot are UNCHANGED
    $updatedSnapshot = OrderProductSnapshot::where('order_item_id', $orderItem->id)->first();
    
    echo "After Update:
";
    echo "Live Product Name: {$product->product_name}
";
    echo "Live Variant Price: {$variant->selling_price}
";
    echo "Snapshot Product Name: {$updatedSnapshot->product_name}
";
    echo "Snapshot Price: {$updatedSnapshot->selling_price}
";

    if ($updatedSnapshot->selling_price == 80.00 && $updatedSnapshot->product_name == 'Original School Shirt') {
        echo "SUCCESS: Order Snapshot remained immutable!
";
    } else {
        throw new Exception("FAILED: Snapshot was modified by vendor update!");
    }

} catch (Throwable $e) {
    echo "ERROR: " . $e->getMessage() . "
";
    echo $e->getTraceAsString();
    exit(1);
}
