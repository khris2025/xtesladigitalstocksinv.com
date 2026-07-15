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
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            // User reference (recommended)
            $table->string('email')->index();

            // Membership details
            $table->string('membership_name');
            $table->integer('amount');

            // Unique membership reference ID (business ID, not DB id)
            $table->string('membership_id')->unique();

            // Dates
            $table->dateTime('purchase_date');
            $table->dateTime('expiry_date');

            // Duration (e.g. 30 days, 90 days)
            $table->integer('duration_days');

            // Status: active, expired, pending, cancelled
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};
