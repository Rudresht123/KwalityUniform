<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('vendor_school_tieups', function (Blueprint $table) {
            $table->id();
            $table->uuid('vendor_id');
            $table->uuid('school_id'); // Assuming schools uses UUID based on previous schema check
            $table->uuid('main_category_id'); // Changed from unsignedBigInteger

            $table->foreign('vendor_id')->references('vendor_id')->on('vendors')->onDelete('cascade');
            $table->foreign('school_id')->references('school_id')->on('schools')->onDelete('cascade');
            $table->foreign('main_category_id')->references('category_id')->on('categories')->onDelete('cascade');
            
            $table->enum('status', ['pending', 'approved', 'rejected', 'cancelled'])->default('pending');
            $table->text('remarks')->nullable();
            
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            
            $table->timestamps();
            
            $table->unique(['vendor_id', 'school_id', 'main_category_id'], 'unique_vendor_school_category');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendor_school_tieups');
    }
};