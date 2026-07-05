<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wishlist_items', function (Blueprint $table) {

            $table->uuid('wishlist_item_id')->primary();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->uuid('product_id');

            $table->uuid('variant_id')->nullable();

            $table->timestamps();

            $table->foreign('product_id')
                ->references('product_id')
                ->on('products')
                ->cascadeOnDelete();

            $table->foreign('variant_id')
                ->references('variant_id')
                ->on('product_variants')
                ->nullOnDelete();

            $table->unique([
                'user_id',
                'variant_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wishlist_items');
    }
};