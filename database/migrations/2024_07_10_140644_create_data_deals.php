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
        Schema::create('data_deals', function (Blueprint $table) {
            $table->id();
            $table->string('zoho_deal_id');
            $table->string('Account_Name');
            $table->string('Deal_Name');
            $table->string('Stage');
            $table->string('Closing_Date');
            $table->string('Amount');
            $table->string('Contact_Name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_deals');
    }
};
