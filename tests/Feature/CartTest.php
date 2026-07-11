<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\SuperAdmin\Product;
use App\Models\SuperAdmin\ProductVariant;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_user_can_add_variant_to_cart()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $product = Product::factory()->approved()->create();
        $variant = ProductVariant::factory()->create(['product_id' => $product->product_id]);

        // We need to identify the cart route. Based on website-routes.php: /cart/add
        $response = $this->post(route('website.cart.add'), [
            'product_id' => $product->product_id,
            'variant_id' => $variant->variant_id,
            'quantity' => 2,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('cart_items', [
            'product_id' => $product->product_id,
            'variant_id' => $variant->variant_id,
            'quantity' => 2,
        ]);
    }

    /** @test */
    public function cannot_add_out_of_stock_variant_to_cart()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $product = Product::factory()->approved()->create();
        $variant = ProductVariant::factory()->create([
            'product_id' => $product->product_id,
            'stock_qty' => 0
        ]);

        $response = $this->post(route('website.cart.add'), [
            'product_id' => $product->product_id,
            'variant_id' => $variant->variant_id,
            'quantity' => 1,
        ]);

        // Expecting a validation error or failure
        $response->assertSessionHasErrors('quantity');
    }

    /** @test */
    public function user_can_update_cart_quantity()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $cart = Cart::factory()->create(['user_id' => $user->id]);
        $product = Product::factory()->approved()->create();
        $variant = ProductVariant::factory()->create(['product_id' => $product->product_id]);
        
        $item = CartItem::factory()->create([
            'cart_id' => $cart->cart_id,
            'product_id' => $product->product_id,
            'variant_id' => $variant->variant_id,
            'quantity' => 1,
        ]);

        $response = $this->post(route('website.cart.update'), [
            'cart_item_id' => $item->cart_item_id,
            'quantity' => 5,
        ]);

        $response->assertRedirect();
        $this->assertEquals(5, $item->fresh()->quantity);
    }
}
