<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\SuperAdmin\Product;
use App\Models\SuperAdmin\ProductVariant;
use App\Models\WishlistItem;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WishlistTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_user_can_add_product_to_wishlist()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $product = Product::factory()->approved()->create();
        $variant = ProductVariant::factory()->create(['product_id' => $product->product_id]);

        // Assuming route exists like /wishlist/add
        $response = $this->post(route('website.wishlist.add'), [
            'product_id' => $product->product_id,
            'variant_id' => $variant->variant_id,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('wishlist_items', [
            'user_id' => $user->id,
            'product_id' => $product->product_id,
            'variant_id' => $variant->variant_id,
        ]);
    }

    /** @test */
    public function wishlist_prevents_duplicate_entries()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $product = Product::factory()->approved()->create();
        $variant = ProductVariant::factory()->create(['product_id' => $product->product_id]);

        $this->post(route('website.wishlist.add'), [
            'product_id' => $product->product_id,
            'variant_id' => $variant->variant_id,
        ]);

        $response = $this->post(route('website.wishlist.add'), [
            'product_id' => $product->product_id,
            'variant_id' => $variant->variant_id,
        ]);

        // Depending on implementation, this might redirect with a notice or just do nothing
        $this->assertEquals(1, WishlistItem::where('user_id', $user->id)->count());
    }

    /** @test */
    public function authenticated_user_can_remove_from_wishlist()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $product = Product::factory()->approved()->create();
        $variant = ProductVariant::factory()->create(['product_id' => $product->product_id]);
        $item = WishlistItem::factory()->create([
            'user_id' => $user->id,
            'product_id' => $product->product_id,
            'variant_id' => $variant->variant_id,
        ]);

        $response = $this->delete(route('website.wishlist.remove', ['id' => $item->wishlist_item_id]));

        $response->assertRedirect();
        $this->assertDatabaseMissing('wishlist_items', ['wishlist_item_id' => $item->wishlist_item_id]);
    }
}
