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

            $table->foreignUuid('standard_id')
                ->nullable()
                ->constrained('school_standards')
                ->cascadeOnDelete();

            $table->foreignUuid('section_id')
                ->nullable()
                ->constrained('school_sections')
                ->cascadeOnDelete();

            $table->timestamps();

            $table->index(['assignment_type']);
            $table->index(['product_id', 'assignment_type']);
            $table->index(['standard_id']);
            $table->index(['section_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_assignments');
    }
};