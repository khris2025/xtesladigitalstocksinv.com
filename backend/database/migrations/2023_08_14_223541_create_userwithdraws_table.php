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
        Schema::create('userwithdraws', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('email');
            $table->string('status')->default('pending');
            $table->integer('amount');
            $table->string('ptype');
            $table->string('transid');
            $table->string('walletaddress');
            $table->string('proof')->nullable();
            $table->integer('fee')->nullable();
            $table->string('method')->nullable();
            $table->string('wfee')->default('no');
            $table->string('fee_name')->nullable();
            $table->dateTime('dateadd'); // Use timestamp() instead of timestamps()
            $table->timestamps(); // This line is for created_at and updated_at columns
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userwithdraws');
    }
};
