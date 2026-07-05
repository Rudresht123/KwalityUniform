<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->foreignId('school_id')->constrained()->cascadeOnDelete();

            $table->string('admission_no')->nullable();

            $table->string('roll_no')->nullable();

            $table->string('first_name');

            $table->string('last_name')->nullable();

            $table->enum('gender', ['male', 'female', 'other']);

            $table->date('date_of_birth')->nullable();

            $table->foreignId('class_id')->nullable()->constrained()->nullOnDelete();

            $table->foreignId('section_id')->nullable()->constrained()->nullOnDelete();

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index(['school_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
