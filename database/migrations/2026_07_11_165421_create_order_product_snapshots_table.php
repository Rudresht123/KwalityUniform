<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_product_snapshots', function (Blueprint $table) {
            $table->uuid('snapshot_id')->primary();
            $table->unsignedBigInteger('order_item_id');
            $table->uuid('product_id')->nullable();
            $table->uuid('vendor_id');
            
            // Product Core Data
            $table->string('category_name')->nullable();
            $table->string('brand_name')->nullable();
            $table->string('product_name');
            $table->text('description')->nullable();
            $table->string('sku')->nullable();
            $table->string('gender')->nullable();
            $table->string('material')->nullable();
            $table->json('specifications')->nullable();
            
            // Pricing
            $table->decimal('selling_price', 10, 2);
            $table->decimal('original_price', 10, 2)->nullable();
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->decimal('tax_amount', 10, 2)->default(0);
            
            // Variant Data
            $table->string('size_name')->nullable();
            $table->string('color_name')->nullable();
            $table->json('variant_details')->nullable();
            
            // Media
            $table->string('thumbnail_url')->nullable();
            $table->json('image_urls')->nullable();
            
            // Context
            $table->string('school_name')->nullable();
            $table->json('delivery_info')->nullable();
            
            $table->timestamps();

            $table->foreign('order_item_id')->references('id')->on('order_items')->onDelete('cascade');
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_product_snapshots');
    }
};
