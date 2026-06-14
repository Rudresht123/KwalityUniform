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
        Schema::create('vendors', function (Blueprint $table) {
            $table->uuid('vendor_id')->primary();
            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->cascadeOnDelete();
            $table->string('business_name', 150)->unique();
            $table->string('owner_name', 100);
            $table->string('email', 150)->unique();
            $table->string('phone', 15);
            $table->text('address');
            $table->string('city', 80);
            $table->string('state', 80);
            $table->string('pincode', 10);
            $table->string('gstin', 20)->nullable();
            $table->string('pan_number', 15)->nullable();
            $table->string('bank_account_no', 25)->nullable();
            $table->string('ifsc_code', 15)->nullable();
            $table->decimal('commission_rate', 5, 2)->default(0);
            $table->enum('status', ['pending', 'approved', 'suspended'])->default('pending');
            $table->enum('is_active', ['1', '0'])->default('0');
            $table->string('logo_url', 255)->nullable();
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
