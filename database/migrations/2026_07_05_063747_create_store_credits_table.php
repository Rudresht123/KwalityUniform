<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('store_credits', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('return_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->enum('transaction_type',[
                'credit',
                'debit'
            ]);

            $table->decimal('amount',10,2);

            $table->decimal('balance',10,2);

            $table->timestamp('expires_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('store_credits');
    }
};