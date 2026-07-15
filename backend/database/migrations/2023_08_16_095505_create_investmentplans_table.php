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
        Schema::create('investmentplans', function (Blueprint $table) {
            $table->id();
            $table->string('fullname'); // User's name
            $table->string('email'); // User's email
            $table->decimal('amount', 10, 2); // Investment amount
            $table->decimal('profit', 10, 2); // Profit
            $table->string('plan'); // Plan name
            $table->string('status')->default('ongoing'); // Investment status (e.g., pending, confirmed)
            $table->string('transid'); // Transaction ID
            $table->string('inv_in')->nullable(); // Withdrawal date (nullable)
            $table->dateTime('Withdrawaldate')->nullable(); // Withdrawal date (nullable)
            $table->dateTime('dateadd')->nullable(); // Withdrawal date (nullable)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investmentplans');
    }
};
