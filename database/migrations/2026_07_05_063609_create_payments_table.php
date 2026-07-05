<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {

            $table->id();

            $table->foreignId('order_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->enum('payment_method', [
                'razorpay',
                'cod',
                'upi',
                'card',
                'net_banking',
                'wallet'
            ]);

            $table->enum('status', [
                'pending',
                'processing',
                'success',
                'failed',
                'cancelled',
                'refunded',
                'partially_refunded'
            ])->default('pending');

            $table->decimal('amount',10,2);

            $table->string('currency',5)->default('INR');

            $table->string('transaction_id')->nullable();

            $table->string('gateway_order_id')->nullable();

            $table->string('gateway_payment_id')->nullable();

            $table->string('gateway_signature')->nullable();

            $table->json('gateway_response')->nullable();

            $table->timestamp('paid_at')->nullable();

            $table->timestamps();

            $table->index(['order_id','status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};