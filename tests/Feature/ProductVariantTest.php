<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\SuperAdmin\Product;
use App\Models\SuperAdmin\ProductVariant;
use App\Models\SuperAdmin\Size;
use App\Models\SuperAdmin\Color;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductVariantTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function variant_can_be_created_with_specific_size_and_color()
    {
        $product = Product::factory()->create();
        $size = Size::factory()->create(); // Assuming Size factory exists, if not I will create it
        $color = Color::factory()->create(); // Assuming Color factory exists, if not I will create it

        $variant = ProductVariant::factory()->create([
            'product_id' => $product->product_id,
            'size_id' => $size->size_id,
            'color_id' => $color->color_id,
            'selling_price' => 1200.00,
            'stock_qty' => 50,
        ]);

        $this->assertEquals($size->size_id, $variant->size_id);
        $this->assertEquals($color->color_id, $variant->color_id);
        $this->assertEquals(1200.00, $variant->selling_price);
    }

    /** @test */
    public function variant_stock_can_be_updated()
    {
        $variant = ProductVariant::factory()->create(['stock_qty' => 10]);

        $variant->update(['stock_qty' => 5]);

        $this->assertEquals(5, $variant->fresh()->stock_qty);
    }

    /** @test */
    public function variant_can_be_marked_as_inactive()
    {
        $variant = ProductVariant::factory()->create(['is_active' => true]);

        $variant->update(['is_active' => false]);

        $this->assertFalse($variant->fresh()->is_active);
    }

    /** @test */
    public function variant_can_be_soft_deleted()
    {
        $variant = ProductVariant::factory()->create();

        $variant->delete();

        $this->assertSoftDeleted($variant);
    }
}
