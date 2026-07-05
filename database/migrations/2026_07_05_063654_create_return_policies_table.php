<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('return_policies', function (Blueprint $table) {

            $table->id();

            // School UUID FK
            $table->uuid('school_id')->nullable();

            $table->foreign('school_id')
                ->references('school_id')
                ->on('schools')
                ->nullOnDelete();

            // Category UUID FK
            $table->uuid('category_id')->nullable();

            $table->foreign('category_id')
                ->references('category_id')
                ->on('categories')
                ->nullOnDelete();

            $table->unsignedInteger('return_window_days')->default(7);

            $table->boolean('allow_return')->default(true);

            $table->boolean('allow_exchange')->default(true);

            $table->boolean('allow_store_credit')->default(true);

            $table->boolean('require_original_tags')->default(true);

            $table->boolean('require_unworn')->default(true);

            $table->decimal('restocking_fee', 10, 2)->default(0);

            $table->boolean('is_final_sale')->default(false);

            $table->text('description')->nullable();

            $table->timestamps();

            $table->unique(['school_id', 'category_id'], 'uq_return_policy_school_category');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('return_policies');
    }
};