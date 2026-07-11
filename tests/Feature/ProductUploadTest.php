<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\SuperAdmin\Product;
use App\Models\SuperAdmin\ProductVariant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductUploadTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    /** @test */
    public function user_can_upload_product_image()
    {
        $user = \App\Models\User::factory()->create();
        $user->assignRole('vendor');
        $this->actingAs($user);

        $product = Product::factory()->create();
        $file = UploadedFile::fake()->image('product.jpg');

        // Assuming route /product/image/store
        $response = $this->post(route('product.image.store'), [
            'product_id' => $product->product_id,
            'image' => $file,
        ]);

        $response->assertRedirect();
        $this->assertCount(1, $product->images);
    }

    /** @test */
    public function cannot_upload_invalid_file_type()
    {
        $user = \App\Models\User::factory()->create();
        $user->assignRole('vendor');
        $this->actingAs($user);

        $product = Product::factory()->create();
        $file = UploadedFile::fake()->create('document.pdf', 100);

        $response = $this->post(route('product.image.store'), [
            'product_id' => $product->product_id,
            'image' => $file,
        ]);

        $response->assertSessionHasErrors('image');
    }
}
