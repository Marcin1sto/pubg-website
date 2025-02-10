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
        Schema::table('players', function (Blueprint $table) {
            $table->dropColumn('playerName');
            $table->dropColumn('clanId');
            $table->string('discord_id')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('players', function (Blueprint $table) {
            $table->string('playerName')->after('id');
            $table->string('clanId')->after('playerName');
            $table->dropColumn('discord_id');
        });
    }
};
