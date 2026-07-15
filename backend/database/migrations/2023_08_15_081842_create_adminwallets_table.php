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
        Schema::create('adminwallets', function (Blueprint $table) {
            $table->id();
            $table->string('btc_address_bitcoin')->nullable();
            $table->string('btc_address_bep20')->nullable();

            $table->string('eth_address_erc20')->nullable();
            $table->string('eth_address_bep20')->nullable();

            $table->string('usdt_address_trc20')->nullable();
            $table->string('usdt_address_bep20')->nullable();
            $table->string('usdt_address_erc20')->nullable();

            $table->string('Phrase_min_amount')->default('0');
            $table->string('daily_earning')->default('0');

            $table->string('btc_address_bitcoin_qr')->nullable();
            $table->string('btc_address_bep20_qr')->nullable();
            $table->string('eth_address_erc20_qr')->nullable();
            $table->string('eth_address_bep20_qr')->nullable();
            $table->string('usdt_address_trc20_qr')->nullable();
            $table->string('usdt_address_bep20_qr')->nullable();
            $table->string('usdt_address_erc20_qr')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adminwallets');
    }
};
