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
        Schema::create('server_configs', function (Blueprint $table) {
            $table->id();
            $table->string('business_name')->nullable();
            $table->string('location')->nullable();
            $table->string('business_id')->nullable();
            $table->string('license_no')->nullable();
            $table->string('establish_date')->nullable();
            $table->string('chairman')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('linked_branch')->nullable();
            $table->string('thana')->nullable();
            $table->string('district')->nullable();
            $table->string('branch_district')->nullable();
            $table->string('routing_number')->nullable();
            $table->string('swift_code')->nullable();
            $table->string('helpline')->nullable();
            $table->string('bank_logo')->nullable();
            $table->string('logo_2')->nullable();
            $table->string('logo_3')->nullable();
            $table->string('status')->nullable();
            $table->string('employee_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('server_configs');
    }
};
