<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {

            $table->id();

            $table->foreignId('order_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->uuid('product_id');

            $table->uuid('variant_id')->nullable();

            $table->uuid('vendor_id');

            $table->string('product_name');

            $table->string('sku')->nullable();

            $table->string('image')->nullable();

            $table->decimal('unit_price',10,2);

            $table->unsignedInteger('quantity');

            $table->decimal('discount_amount',10,2)->default(0);

            $table->decimal('tax_amount',10,2)->default(0);

            $table->decimal('line_total',10,2);

            $table->unsignedInteger('returned_quantity')->default(0);

            $table->timestamps();

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
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};