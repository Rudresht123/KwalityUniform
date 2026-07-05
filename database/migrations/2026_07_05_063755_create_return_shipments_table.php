<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('return_shipments', function (Blueprint $table) {

            $table->id();

            $table->foreignId('return_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('courier_name')->nullable();

            $table->string('tracking_number')->nullable();

            $table->string('tracking_url')->nullable();

            $table->enum('status',[
                'pending',
                'picked_up',
                'in_transit',
                'delivered'
            ])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('return_shipments');
    }
};