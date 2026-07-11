<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use App\Repositories\ProductRepository;
use App\Models\SuperAdmin\Product;
use App\Models\SuperAdmin\Category;
use App\Models\SuperAdmin\Vendor;
use App\Models\SuperAdmin\School;
use App\Models\SuperAdmin\SchoolProductApproval;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;

class ProductRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected ProductRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new ProductRepository();
        
        // Ensure roles exist
        Role::firstOrCreate(['name' => 'super-admin']);
        Role::firstOrCreate(['name' => 'vendor']);
        Role::firstOrCreate(['name' => 'school']);
    }

    public function test_super_admin_can_see_all_products()
    {
        $user = User::factory()->create();
        $user->assignRole('super-admin');
        $this->actingAs($user);

        Product::factory()->count(3)->create();

        $products = $this->repository->getVisibleProducts();

        $this->assertCount(3, $products);
    }

    public function test_vendor_can_see_only_their_own_products()
    {
        $vendorUser = User::factory()->create();
        $vendorUser->assignRole('vendor');
        
        // Create vendor profile
        $vendor = \Database\Factories\SuperAdmin\VendorFactory::new()->create([
            'user_id' => $vendorUser->id
        ]);
        
        $this->actingAs($vendorUser);

        // Own products
        Product::factory()->count(2)->create(['vendor_id' => $vendor->vendor_id]);
        // Other products
        Product::factory()->count(2)->create();

        $products = $this->repository->getVisibleProducts();

        $this->assertCount(2, $products);
        foreach ($products as $product) {
            $this->assertEquals($vendor->vendor_id, $product->vendor_id);
        }
    }

    public function test_guest_sees_only_approved_products()
    {
        // Not acting as any user
        Product::factory()->count(3)->approved()->create();
        Product::factory()->count(2)->rejected()->create();
        Product::factory()->count(2)->create(['approval_status' => 'pending']);

        $products = $this->repository->getVisibleProducts();

        $this->assertCount(3, $products);
        foreach ($products as $product) {
            $this->assertEquals('approved', $product->approval_status);
        }
    }

    public function test_search_returns_empty_if_no_school_provided()
    {
        Product::factory()->count(5)->approved()->create();

        $results = $this->repository->searchProducts([
            'school' => 'all'
        ]);

        $this->assertTrue($results->isEmpty());
    }

    public function test_search_filters_by_school()
    {
        $school = School::factory()->create();
        $product = Product::factory()->approved()->create();
        
        SchoolProductApproval::factory()->create([
            'school_id' => $school->school_id,
            'product_id' => $product->product_id,
        ]);

        $otherProduct = Product::factory()->approved()->create();

        $results = $this->repository->searchProducts([
            'school' => $school->school_id
        ]);

        $this->assertTrue($results->contains('product_id', $product->product_id));
        $this->assertFalse($results->contains('product_id', $otherProduct->product_id));
    }

    public function test_search_filters_by_keyword()
    {
        $school = School::factory()->create();
        $product = Product::factory()->approved()->create([
            'product_name' => 'Unique Uniform Shirt',
        ]);
        
        SchoolProductApproval::factory()->create([
            'school_id' => $school->school_id,
            'product_id' => $product->product_id,
        ]);

        $results = $this->repository->searchProducts([
            'school' => $school->school_id,
            'search' => 'Unique Uniform'
        ]);

        $this->assertTrue($results->contains('product_id', $product->product_id));
    }

    public function test_find_by_id_returns_correct_product()
    {
        $product = Product::factory()->create();

        $found = $this->repository->findById($product->product_id);

        $this->assertEquals($product->product_id, $found->product_id);
    }

    public function test_update_modifies_product_data()
    {
        $product = Product::factory()->create(['product_name' => 'Old Name']);

        $this->repository->update($product->product_id, ['product_name' => 'New Name']);
        
        $this->assertEquals('New Name', $product->fresh()->product_name);
    }
}
