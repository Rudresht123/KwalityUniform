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
        Schema::create('partnerships', function (Blueprint $table) {
            $table->uuid('id')->primary();
            
            // Explicitly defining references to custom ID columns
            $table->foreignUuid('school_id')->references('school_id')->on('schools')->onDelete('cascade');
            $table->foreignUuid('vendor_id')->references('vendor_id')->on('vendors')->onDelete('cascade');
            $table->foreignUuid('category_id')->references('category_id')->on('categories')->onDelete('cascade');
            
            $table->enum('status', ['pending', 'active', 'inactive', 'rejected', 'cancelled'])->default('pending');
            $table->text('remarks')->nullable();
            $table->timestamp('approved_at')->nullable();
            
            // 'users' uses standard bigint 'id'
            $table->foreignId('approved_by')->nullable()->constrained('users');
            
            $table->timestamp('ended_at')->nullable();
            $table->timestamps();

            // PERFORMANCE INDEXES
            $table->index(['school_id', 'category_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partnerships');
    }
};
