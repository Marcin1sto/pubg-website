<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayerMatchStatisticTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_match_statistic', function (Blueprint $table) {
            $table->id();
            $table->softDeletes();
            $table->timestamps();
            $table->unsignedBigInteger('season_id');
            $table->unsignedBigInteger('player_id')->default(0);
            $table->string('match_id')->default(0);
            $table->string('type')->default(0);
            $table->string('idPlayerMatch')->default(0);
            $table->integer('DBNOs')->default(0);
            $table->integer('assists')->default(0);
            $table->integer('boosts')->default(0);
            $table->bigInteger('damageDealt')->default(0);
            $table->string('deathType')->default(0);
            $table->integer('headshotKills')->default(0);
            $table->integer('heals')->default(0);
            $table->integer('killPlace')->default(0);
            $table->integer('killStreaks')->default(0);
            $table->integer('kills')->default(0);
            $table->bigInteger('longestKill')->default(0);
            $table->string('name')->default(0);
            $table->integer('revives')->default(0);
            $table->integer('rideDistance')->default(0);
            $table->integer('roadKills')->default(0);
            $table->integer('swimDistance')->default(0);
            $table->integer('teamKills')->default(0);
            $table->integer('timeSurvived')->default(0);
            $table->integer('vehicleDestroys')->default(0);
            $table->bigInteger('walkDistance')->default(0);
            $table->integer('weaponsAcquired')->default(0);
            $table->integer('winPlace')->default(0);

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
        Schema::dropIfExists('player_match_statistic');
    }
}
