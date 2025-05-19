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
        Schema::create('account_lists', function (Blueprint $table) {
            $table->id();
            $table->string('acName')->nullable();
            $table->string('acNumber')->nullable();
            $table->string('acType')->nullable();
            $table->string('acMobile')->nullable();
            $table->string('acFinger')->nullable();
            $table->string('acStatus')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_lists');
    }
};
