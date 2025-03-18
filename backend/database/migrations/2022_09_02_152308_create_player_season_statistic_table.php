<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayerSeasonStatisticTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_season_statistic', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('season_id');
            $table->unsignedBigInteger('player_id');
            $table->enum('type', ['squad', 'solo', 'duo', 'duo-fpp', 'solo-fpp', 'squad-fpp']);
            $table->integer('assists')->default(0);
            $table->integer('boosts')->default(0);
            $table->integer('dBNOs')->default(0);
            $table->integer('dailyKills')->default(0);
            $table->integer('dailyWins')->default(0);
            $table->integer('damageDealt')->default(0);
            $table->integer('days')->default(0);
            $table->integer('headshotKills')->default(0);
            $table->integer('heals')->default(0);
            $table->integer('killPoints')->default(0);
            $table->integer('kills')->default(0);
            $table->integer('longestKill')->default(0);
            $table->integer('longestTimeSurvived')->default(0);
            $table->integer('losses')->default(0);
            $table->integer('maxKillStreaks')->default(0);
            $table->integer('mostSurvivalTime')->default(0);
            $table->integer('rankPoints')->default(0);
            $table->string('rankPointsTitle')->nullable();
            $table->integer('revives')->default(0);
            $table->integer('rideDistance')->default(0);
            $table->integer('roadKills')->default(0);
            $table->integer('roundMostKills')->default(0);
            $table->integer('roundsPlayed')->default(0);
            $table->integer('suicides')->default(0);
            $table->integer('swimDistance')->default(0);
            $table->integer('teamKills')->default(0);
            $table->integer('timeSurvived')->default(0);
            $table->integer('top10s')->default(0);
            $table->integer('vehicleDestroys')->default(0);
            $table->integer('walkDistance')->default(0);
            $table->integer('weaponsAcquired')->default(0);
            $table->integer('weeklyKills')->default(0);
            $table->integer('weeklyWins')->default(0);
            $table->integer('winPoints')->default(0);
            $table->integer('wins')->default(0);

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
        Schema::dropIfExists('player_season_statistic');
    }
}
