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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->uuid('variant_id')->primary();
            $table->uuid('product_id');

            $table->string('sku', 60)->unique();

            $table->uuid('size_id')->nullable();
            $table->uuid('color_id')->nullable();

            $table->decimal('mrp', 10, 2);
            $table->decimal('selling_price', 10, 2);

            $table->unsignedInteger('stock_qty')->default(0);
            $table->unsignedInteger('low_stock_alert')->default(5);

            $table->string('barcode', 60)->nullable()->unique();

            $table->boolean('is_active')->default(true);

            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('size_id')->references('size_id')->on('sizes')->onDelete('set null');
            $table->foreign('color_id')->references('color_id')->on('colors')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('deleted_by')->references('id')->on('users');

            $table->unique(['product_id', 'size_id', 'color_id'], 'uq_variant_combination');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
