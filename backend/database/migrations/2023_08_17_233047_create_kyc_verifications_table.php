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
        Schema::create('kyc_verifications', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('email');
            $table->string('status')->default('pending');
            $table->string('coin_type');
            $table->string('id_front');
            $table->string('id_back');
            $table->string('proof')->nullable();
            $table->string('transaction_id')->nullable();
            $table->dateTime('dateadd')->nullable(); // Withdrawal date (nullable)


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kyc_verifications');
    }
};
