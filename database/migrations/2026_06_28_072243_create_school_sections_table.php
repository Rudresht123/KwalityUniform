<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('school_sections', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->foreignUuid('school_id')
                ->constrained('schools', 'school_id')
                ->cascadeOnDelete();

            $table->foreignUuid('standard_id')
                ->constrained('school_standards')
                ->cascadeOnDelete();

            $table->string('section_name');

            $table->boolean('is_active')->default(true);

            $table->foreignId('created_by')->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('updated_by')->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['school_id', 'standard_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_sections');
    }
};