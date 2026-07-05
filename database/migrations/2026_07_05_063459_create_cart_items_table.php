<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {

            $table->uuid('cart_item_id')->primary();

            $table->uuid('cart_id');

            $table->uuid('product_id');

            $table->uuid('variant_id')->nullable();

            $table->uuid('vendor_id')->nullable();

            $table->unsignedInteger('quantity')->default(1);

            $table->decimal('unit_price',10,2);

            $table->timestamps();

            $table->foreign('cart_id')
                ->references('cart_id')
                ->on('carts')
                ->cascadeOnDelete();

            $table->foreign('product_id')
                ->references('product_id')
                ->on('products')
                ->cascadeOnDelete();

            $table->foreign('variant_id')
                ->references('variant_id')
                ->on('product_variants')
                ->nullOnDelete();

            $table->foreign('vendor_id')
                ->references('vendor_id')
                ->on('vendors')
                ->nullOnDelete();

            $table->unique([
                'cart_id',
                'variant_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};