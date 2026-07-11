<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\SuperAdmin\Product;
use App\Models\SuperAdmin\Category;
use App\Models\SuperAdmin\Vendor;
use App\Models\SuperAdmin\ProductVariant;
use App\Models\SuperAdmin\ProductImage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void

    {
        parent::setUp();
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'super-admin']);
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'vendor']);
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'school']);
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin']);
    }

    public function test_it_generates_a_uuid_on_creation()
    {
        $product = Product::factory()->create();

        $this->assertEquals(36, strlen($product->product_id));
        $this->assertTrue(Str::isUuid($product->product_id));
    }

    public function test_it_has_fillable_attributes()
    {
        $user = \App\Models\User::factory()->create();
        $data = [
            'product_name' => 'Test Product',
            'product_code' => 'TP-001',
            'slug' => 'test-product',
            'category_id' => Category::factory()->create()->category_id,
            'vendor_id' => Vendor::factory()->create()->vendor_id,
            'description' => 'Test Description',
            'approval_status' => 'pending',
            'is_active' => true,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ];

        $product = Product::create($data);

        $this->assertEquals('Test Product', $product->product_name);
        $this->assertEquals('TP-001', $product->product_code);
    }

    public function test_it_casts_boolean_attributes()
    {
        $product = Product::factory()->create(['is_active' => 1]);
        $this->assertTrue($product->is_active);

        $product->is_active = 0;
        $product->save();
        $this->assertFalse($product->is_active);
    }

    public function test_it_applies_approved_scope()
    {
        Product::factory()->count(2)->approved()->create();
        Product::factory()->count(2)->rejected()->create();

        $approvedProducts = Product::approved()->get();

        $this->assertCount(2, $approvedProducts);
        foreach ($approvedProducts as $product) {
            $this->assertEquals('approved', $product->approval_status);
        }
    }

    public function test_it_applies_active_scope()
    {
        Product::factory()->count(2)->create(['is_active' => true]);
        Product::factory()->count(2)->inactive()->create();

        $activeProducts = Product::active()->get();

        $this->assertCount(2, $activeProducts);
        foreach ($activeProducts as $product) {
            $this->assertTrue($product->is_active);
        }
    }

    public function test_it_belongs_to_a_category()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->category_id]);

        $this->assertTrue($product->category()->exists());
        $this->assertEquals($category->category_id, $product->category->category_id);
    }

    public function test_it_belongs_to_a_vendor()
    {
        $vendor = Vendor::factory()->create();
        $product = Product::factory()->create(['vendor_id' => $vendor->vendor_id]);

        $this->assertTrue($product->vendor()->exists());
        $this->assertEquals($vendor->vendor_id, $product->vendor->vendor_id);
    }

    public function test_it_has_many_variants()
    {
        $product = Product::factory()->create();
        ProductVariant::factory()->count(3)->create(['product_id' => $product->product_id]);

        $this->assertCount(3, $product->variants);
    }

    public function test_it_has_many_images()
    {
        $product = Product::factory()->create();
        ProductImage::factory()->count(3)->create(['product_id' => $product->product_id]);

        $this->assertCount(3, $product->images);
    }

    public function test_it_returns_default_image_url_when_no_primary_image_exists()
    {
        $product = Product::factory()->create();
        
        $this->assertStringContainsString('no_image.jpg', $product->firstImage());
    }
}
