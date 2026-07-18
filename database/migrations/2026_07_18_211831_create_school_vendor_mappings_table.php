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
        Schema::create('school_vendor_mappings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('school_id');
            $table->uuid('vendor_id');
            $table->timestamps();

            $table->foreign('school_id')->references('school_id')->on('schools')->onDelete('cascade');
            $table->foreign('vendor_id')->references('vendor_id')->on('vendors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_vendor_mappings');
    }
};
