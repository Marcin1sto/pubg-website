<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllPubgPlayersStatisticTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('all_pubg_players_statists', function (Blueprint $table) {
            $table->integer('count_players');
            $table->integer('count_wins');
            $table->integer('count_kills');
            $table->integer('count_matches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('all_pubg_players_statists');
    }
}
