<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayerStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_stats', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('player_id');
            $table->unsignedBigInteger('season_id');
            $table->integer('points');
            $table->integer('wins');
            $table->integer('percent_wins');
            $table->integer('matches');
            $table->float('kd');
            $table->float('kda');
            $table->integer('percent_headshot');

            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('cascade');
            $table->foreign('player_id')->references('id')->on('players')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('player_stats');
    }
}
