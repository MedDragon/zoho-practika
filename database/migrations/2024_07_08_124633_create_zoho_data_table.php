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
        Schema::create('zoho_data', function (Blueprint $table) {
            $table->id('zohoID');
            $table->string('First_Name');
            $table->string('Last_Name');
            $table->string('Email');
            $table->string('Mobile');
            $table->string('Account_Name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zoho_data');
    }
};
