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
        if (!Schema::hasTable('web_users')) {
            Schema::create('web_users', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->string('address')->nullable();
                $table->string('city')->nullable();
                $table->string('state')->nullable();
                $table->string('zip_code', 10)->nullable();
                $table->string('alternate_phone', 15)->nullable();
                $table->string('gender')->nullable();
                $table->date('date_of_birth')->nullable();
                $table->string('national_id')->nullable();
                $table->string('emergency_contact_name')->nullable();
                $table->string('emergency_contact_phone', 15)->nullable();
                $table->string('emergency_contact_relationship')->nullable();
                $table->text('notes')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_users');
    }
};
