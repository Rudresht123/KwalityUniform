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
        Schema::create('school_product_class_approvals', function (Blueprint $table) {
            $table->id();
            $table->uuid('school_product_approval_id');
            $table->uuid('class_id');
            $table->timestamps();

            $table->foreign('school_product_approval_id','fk_spca_approval')->references('school_product_approval_id')->on('school_product_approvals')->onDelete('cascade');
            $table->foreign('class_id')->references('id')->on('school_classes')->onDelete('cascade');
        });
    }

    /**
     * Remove the migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_product_class_approvals');
    }
};
