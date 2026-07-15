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
        Schema::create('copy_traders', function (Blueprint $table) {
            $table->id();
            $table->string('tradersname'); // Trader Name
            $table->string('tradersimg')->nullable(); // Picture URL or path
            $table->string('return_rate');
            $table->string('followers');
            $table->string('profitshare');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('copy_traders');
    }
};
