<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->id();

            // UUID
            $table->uuid('product_id');

            $table->foreign('product_id')->references('product_id')->on('products')->cascadeOnDelete();

            // BIGINT
            $table->foreignId('order_item_id')->nullable()->constrained('order_items')->nullOnDelete();

            // BIGINT
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            $table->tinyInteger('rating');

            $table->string('title')->nullable();

            $table->text('review')->nullable();

            $table->boolean('verified_purchase')->default(true);

            $table->boolean('is_approved')->default(false);

            $table->timestamps();

            $table->index(['product_id', 'rating']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_reviews');
    }
};
