<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_assignments', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->foreignUuid('product_id')
                ->constrained('products', 'product_id')
                ->cascadeOnDelete();

            $table->enum('assignment_type', ['standard', 'section']);


            $table->timestamps();

            $table->index(['assignment_type']);
            $table->index(['product_id', 'assignment_type']);
    
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_assignments');
    }
};