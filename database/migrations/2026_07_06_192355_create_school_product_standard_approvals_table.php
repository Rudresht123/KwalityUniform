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
        Schema::create('school_product_standard_approvals', function (Blueprint $table) {
            $table->id();
            $table->uuid('school_product_approval_id');
            $table->uuid('standard_id');
            $table->timestamps();

            $table->foreign('school_product_approval_id', 'fk_spsa_approval')
                  ->references('school_product_approval_id')
                  ->on('school_product_approvals')
                  ->onDelete('cascade');

            $table->foreign('standard_id', 'fk_spsa_standard')
                  ->references('id')
                  ->on('school_standards')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_product_standard_approvals');
    }
};
