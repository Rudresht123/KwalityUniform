<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('return_reasons', function (Blueprint $table) {

            $table->id();

            $table->string('reason');

            $table->boolean('require_comment')->default(false);

            $table->boolean('require_photo')->default(false);

            $table->boolean('is_active')->default(true);

            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('return_reasons');
    }
};