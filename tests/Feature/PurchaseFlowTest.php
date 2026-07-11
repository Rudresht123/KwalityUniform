<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\SuperAdmin\Product;
use App\Models\SuperAdmin\ProductVariant;
use App\Models\SuperAdmin\School;
use App\Models\SuperAdmin\SchoolProductApproval;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Mail;

use App\Mail\OrderConfirmedMail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PurchaseFlowTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    protected function setUp(): void

    {
        parent::setUp();
        Mail::fake();
        Storage::fake('public');
    }

    private function createTestProductWithStock($qty = 10)
    {
        $school = School::factory()->create(['is_active' => true]);
        $product = Product::factory()->create([
            'approval_status' => 'approved',
            'is_active' => true,
            'product_code' => 'TEST-CODE-' . Str::random(5),
        ]);

        // Approve product for school
        $user = User::factory()->create();
        SchoolProductApproval::create([
            'school_product_approval_id' => Str::uuid(),
            'school_id' => $school->school_id,
            'product_id' => $product->product_id,
            'status' => 'approved',
            'actioned_by' => $user->id,
        ]);

        $variant = ProductVariant::factory()->create([
            'variant_id' => Str::uuid(),
            'product_id' => $product->product_id,
            'stock_qty' => $qty,
            'is_active' => true,
            'selling_price' => 100.00,
        ]);

        return [$product, $variant, $school];
    }

    public function test_successful_purchase_flow()
    {
        // 1. Setup User and Product
        $user = User::factory()->create();
        $this->actingAs($user);
        [$product, $variant, $school] = $this->createTestProductWithStock(10);

        // 2. Setup Cart
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
            'quantity' => 2,
            'unit_price' => 100.00,
            'vendor_id' => $product->vendor_id,
        ]);

        // 3. Setup Session Details (Simulating form submission)
        session([
            'checkout_details' => [
                'full_name' => 'Test Customer',
                'email' => 'customer@example.com',
                'phone' => '1234567890',
                'city' => 'Noida',
                'address' => '123 Test St',
                'payment_method' => 'cod',
                'delivery_type' => 'school',
            ]
        ]);

        // 4. Execute Purchase
        $response = $this->postJson('/checkout/store', session('checkout_details'));

        // 5. Assertions
        $response->assertStatus(200)
                 ->assertJson(['success' => true]);

        // Check Order Created
        $this->assertDatabaseHas('orders', [
            'grand_total' => 200.00,
            'status' => 'pending',
        ]);

        // Check Stock Deducted (10 - 2 = 8)
        $this->assertDatabaseHas('product_variants', [
            'variant_id' => $variant->variant_id,
            'stock_qty' => 8,
        ]);

        // Check Cart Cleared
        $this->assertEquals(0, CartItem::where('cart_id', $cart->cart_id)->count());

        // Check PDF Invoice Generated
        $order = \App\Models\Order::first();
        $this->assertNotNull($response->json('invoice_url'));

        // Check Email Sent
        Mail::assertQueued(OrderConfirmedMail::class, function ($mail) use ($order) {
            return $mail->order->id === $order->id;
        });
    }

    public function test_purchase_fails_due_to_insufficient_stock()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        [$product, $variant, $school] = $this->createTestProductWithStock(2); // Only 2 available

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
            'quantity' => 5, // Try to buy 5
            'unit_price' => 100.00,
            'vendor_id' => $product->vendor_id,
        ]);

        session(['checkout_details' => [
            'full_name' => 'Test Customer',
            'email' => 'customer@example.com',
            'phone' => '1234567890',
            'city' => 'Noida',
            'address' => '123 Test St',
            'payment_method' => 'cod',
            'delivery_type' => 'school',
        ]]);

        $response = $this->postJson('/checkout/store');

        $response->assertStatus(422)
                 ->assertJsonFragment(['success' => false]);

        // Check Stock NOT deducted
        $this->assertDatabaseHas('product_variants', [
            'variant_id' => $variant->variant_id,
            'stock_qty' => 2,
        ]);

        // Check Order NOT created
        $this->assertEquals(0, \App\Models\Order::count());
    }

    public function test_purchase_fails_due_to_inactive_product()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        [$product, $variant, $school] = $this->createTestProductWithStock(10);
        
        // Make product inactive
        $product->update(['is_active' => false]);

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
            'quantity' => 1,
            'unit_price' => 100.00,
            'vendor_id' => $product->vendor_id,
        ]);

        session(['checkout_details' => [
            'full_name' => 'Test Customer',
            'email' => 'customer@example.com',
            'phone' => '1234567890',
            'city' => 'Noida',
            'address' => '123 Test St',
            'payment_method' => 'cod',
            'delivery_type' => 'school',
        ]]);

        $response = $this->postJson('/checkout/store');

        $response->assertStatus(422)
                 ->assertJsonFragment(['success' => false]);
        
        $this->assertEquals(0, \App\Models\Order::count());
    }
}
