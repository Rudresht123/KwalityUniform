<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\SuperAdmin\Product;
use App\Models\SuperAdmin\ProductVariant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductApprovalTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'super-admin']);
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'vendor']);
    }

    /** @test */
    public function vendor_can_create_product_with_pending_status()
    {
        $vendorUser = User::factory()->create();
        $vendorUser->assignRole('vendor');
        $this->actingAs($vendorUser);

        $response = $this->post(route('product.store'), [
            'product_name' => 'New Vendor Product',
            'product_code' => 'VEND-001',
            'category_id' => \App\Models\SuperAdmin\Category::factory(),
            'vendor_id' => \App\Models\SuperAdmin\Vendor::factory(['user_id' => $vendorUser->id])->vendor_id,
            'description' => 'A great product',
            'fabric_composition' => '100% Cotton',
            'gender_type' => 'Unisex',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('products', [
            'product_name' => 'New Vendor Product',
            'approval_status' => 'pending'
        ]);
    }

    /** @test */
    public function super_admin_can_approve_pending_product()
    {
        $adminUser = User::factory()->create();
        $adminUser->assignRole('super-admin');
        $this->actingAs($adminUser);

        $product = Product::factory()->create(['approval_status' => 'pending']);

        $response = $this->post(route('product-approval.approve'), [
            'product_id' => $product->product_id
        ]);

        $response->assertRedirect();
        $this->assertEquals('approved', $product->fresh()->approval_status);
    }

    /** @test */
    public function super_admin_can_reject_pending_product()
    {
        $adminUser = User::factory()->create();
        $adminUser->assignRole('super-admin');
        $this->actingAs($adminUser);

        $product = Product::factory()->create(['approval_status' => 'pending']);

        $response = $this->post(route('product-approval.reject'), [
            'product_id' => $product->product_id,
            'reason' => 'Poor quality'
        ]);

        $response->assertRedirect();
        $this->assertEquals('rejected', $product->fresh()->approval_status);
        $this->assertEquals('Poor quality', $product->fresh()->rejection_reason);
    }
}
