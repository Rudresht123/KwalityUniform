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
        Schema::create('schools', function (Blueprint $table) {

            $table->uuid('school_id')->primary();

            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('school_name', 200)->unique();

            $table->string('principal_name', 100);

            $table->string('email', 150)->unique();

            $table->string('phone', 15);

            $table->text('address');

            $table->string('city', 80);

            $table->string('state', 80);

            $table->string('pincode', 10);

            $table->string('affiliation_no', 30)
                ->nullable();


            $table->string('logo_url')
                ->nullable();

            $table->boolean('is_active')
                ->default(true);

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('updated_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            $table->index('school_name');
            $table->index('city');
            $table->index('state');
            $table->index('is_active');
               $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
