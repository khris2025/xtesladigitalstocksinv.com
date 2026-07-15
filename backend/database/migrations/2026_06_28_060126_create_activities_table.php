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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('email')->index();

            // Type of activity (deposit, withdrawal, membership, referral, login, etc.)
            $table->string('activity_type');

            // Status (success, pending, failed, completed, etc.)
            $table->string('status')->default('success');

            // Nullable because not all activities involve money
            $table->integer('amount')->nullable();

            // Optional description for UI feed
            $table->string('title')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
