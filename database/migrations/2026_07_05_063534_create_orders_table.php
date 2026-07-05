<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {

            $table->id();

            $table->string('order_number')->unique();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->uuid('school_id')->nullable();

            $table->uuid('vendor_id')->nullable();

           $table->uuid('cart_id')->nullable();


            $table->enum('status',[
                'pending',
                'confirmed',
                'processing',
                'packed',
                'shipped',
                'delivered',
                'cancelled',
                'returned',
                'refunded'
            ])->default('pending');

            $table->enum('payment_status',[
                'pending',
                'paid',
                'failed',
                'refunded'
            ])->default('pending');

            $table->decimal('subtotal',10,2);

            $table->decimal('discount_amount',10,2)->default(0);

            $table->decimal('tax_amount',10,2)->default(0);

            $table->decimal('shipping_charge',10,2)->default(0);

            $table->decimal('grand_total',10,2);

            $table->text('customer_note')->nullable();

            $table->timestamp('placed_at')->nullable();

            $table->timestamp('delivered_at')->nullable();

            $table->timestamps();

            $table->foreign('school_id')
                ->references('school_id')
                ->on('schools')
                ->nullOnDelete();

            $table->foreign('vendor_id')
                ->references('vendor_id')
                ->on('vendors')
                ->nullOnDelete();

                $table->foreign('cart_id')
      ->references('cart_id')
      ->on('carts')
      ->nullOnDelete();

            $table->index(['user_id','status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};