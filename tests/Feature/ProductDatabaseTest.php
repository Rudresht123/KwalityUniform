<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\SuperAdmin\Product;
use App\Models\SuperAdmin\ProductVariant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

class ProductDatabaseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function product_uuid_is_unique_and_consistent()
    {
        $product = Product::factory()->create();
        $this->assertTrue(Str::isUuid($product->product_id));
        
        $this->expectException(\Illuminate\Database\QueryException::class);
        Product::factory()->create(['product_id' => $product->product_id]);
    }

    /** @test */
    public function product_soft_deletes_correctly()
    {
        $product = Product::factory()->create();
        $product->delete();

        $this->assertSoftDeleted($product);
        $this->assertDatabaseHas('products', ['product_id' => $product->product_id, 'deleted_at' => now()->toDateString()]);
    }

    /** @test */
    public function deleting_product_cascades_to_variants()
    {
        $product = Product::factory()->create();
        ProductVariant::factory()->count(3)->create(['product_id' => $product->product_id]);

        $product->delete();

        // Depending on DB configuration, this should be a soft delete or a cascade
        // If we use soft deletes on variants too:
        $this->assertCount(3, ProductVariant::onlyTrashed()->where('product_id', $product->product_id)->get());
    }
}
