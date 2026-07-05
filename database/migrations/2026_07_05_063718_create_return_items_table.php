<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('return_items', function (Blueprint $table) {

            $table->id();

            // returns.id (BIGINT)
            $table->foreignId('return_id')
                ->constrained('returns')
                ->cascadeOnDelete();

            // order_items.id (BIGINT)
            $table->foreignId('order_item_id')
                ->constrained('order_items')
                ->cascadeOnDelete();

            // return_reasons.id (BIGINT)
            $table->foreignId('return_reason_id')
                ->constrained('return_reasons')
                ->restrictOnDelete();

            $table->unsignedInteger('quantity');

            $table->text('customer_comment')->nullable();

            $table->enum('condition', [
                'new',
                'used',
                'damaged',
                'defective'
            ])->nullable();

            $table->enum('inspection_status', [
                'pending',
                'approved',
                'rejected'
            ])->default('pending');

            $table->text('inspection_note')->nullable();

            // product_variants.variant_id (UUID)
            $table->uuid('exchange_variant_id')->nullable();

            $table->foreign('exchange_variant_id')
                ->references('variant_id')
                ->on('product_variants')
                ->nullOnDelete();

            $table->decimal('refund_amount', 10, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('return_items');
    }
};