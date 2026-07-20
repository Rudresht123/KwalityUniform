<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->uuid('id')->primary();
            // Referencing custom ID columns
            $table->foreignUuid('school_id')->references('school_id')->on('schools')->onDelete('cascade');
            
            // Using constrainedId for compatibility with standard bigint 'id'
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // The parent/user
            
            $table->string('student_name');
            $table->string('student_class');
            $table->string('student_section');
            $table->timestamps();
        });

        Schema::table('orders', function (Blueprint $table) {
            // Drop old columns
            $table->dropColumn(['student_name', 'student_class', 'student_section']);
            // Add reference
            $table->foreignUuid('student_id')->nullable()->after('customer_note')->constrained('students')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
            $table->dropColumn('student_id');
            $table->string('student_name')->nullable();
            $table->string('student_class')->nullable();
            $table->string('student_section')->nullable();
        });
        Schema::dropIfExists('students');
    }
};
