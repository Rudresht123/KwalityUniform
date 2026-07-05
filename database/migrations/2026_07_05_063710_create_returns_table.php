<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('returns', function (Blueprint $table) {

            $table->id();

            $table->string('return_number')->unique();

            // orders.id (BIGINT)
            $table->foreignId('order_id')
                ->constrained('orders')
                ->cascadeOnDelete();

            // users.id (BIGINT)
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // vendors.vendor_id (UUID)
            $table->uuid('vendor_id')->nullable();

            $table->foreign('vendor_id')
                ->references('vendor_id')
                ->on('vendors')
                ->nullOnDelete();

            $table->enum('return_type', [
                'refund',
                'exchange',
                'store_credit'
            ]);

            $table->enum('status', [
                'requested',
                'approved',
                'rejected',
                'pickup_scheduled',
                'picked_up',
                'received',
                'inspecting',
                'completed',
                'cancelled'
            ])->default('requested');

            $table->text('customer_note')->nullable();

            $table->text('admin_note')->nullable();

            $table->timestamp('requested_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('completed_at')->nullable();

            $table->foreignId('handled_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            $table->index(['order_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('returns');
    }
};