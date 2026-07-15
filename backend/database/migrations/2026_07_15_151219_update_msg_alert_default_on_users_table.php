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
        Schema::table('users', function (Blueprint $table) {
            $table->string('msg_alert')
                ->nullable()
                ->default('none')
                ->change();
        });

        DB::table('users')
        ->whereNull('msg_alert')
        ->update(['msg_alert' => 'none']);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('msg_alert')
                ->nullable()
                ->default(null)
                ->change();
        });
    }
};
