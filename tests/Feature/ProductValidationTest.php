<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\SuperAdmin\Product;
use App\Models\SuperAdmin\Category;
use App\Models\SuperAdmin\Vendor;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductValidationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function product_creation_requires_name_and_category()
    {
        $user = \App\Models\User::factory()->create();
        $user->assignRole('vendor');
        $this->actingAs($user);

        $response = $this->post(route('product.store'), [
            'product_name' => '', // Missing
            'category_id' => '', // Missing
        ]);

        $response->assertSessionHasErrors(['product_name', 'category_id']);
    }

    /** @test */
    public function product_cannot_have_negative_price_in_variants()
    {
        $product = Product::factory()->create();
        
        $response = $this->post(route('product-variant.store'), [ // Assuming this route exists
            'product_id' => $product->product_id,
            'selling_price' => -100,
        ]);

        $response->assertSessionHasErrors('selling_price');
    }

    /** @test */
    public function product_code_must_be_unique()
    {
        Product::factory()->create(['product_code' => 'UNIQ-123']);
        
        $user = \App\Models\User::factory()->create();
        $user->assignRole('vendor');
        $this->actingAs($user);

        $response = $this->post(route('product.store'), [
            'product_name' => 'Another Product',
            'product_code' => 'UNIQ-123', // Duplicate
            'category_id' => Category::factory(),
            'vendor_id' => Vendor::factory(),
        ]);

        $response->assertSessionHasErrors('product_code');
    }
}
