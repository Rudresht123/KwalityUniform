<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {

            $table->uuid('cart_id')->primary();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->uuid('school_id')->nullable();

            $table->string('session_id')->nullable()->index();

            $table->enum('status', [
                'active',
                'converted',
                'abandoned',
                'completed'
            ])->default('active');

            $table->timestamp('converted_at')->nullable();

            $table->timestamps();

            $table->foreign('school_id')
                ->references('school_id')
                ->on('schools')
                ->nullOnDelete();

            $table->index(['user_id','status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};