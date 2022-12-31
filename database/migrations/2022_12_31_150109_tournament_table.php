<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TournamentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournament', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('number');
            $table->string('type');
            $table->integer('max_groups');
            $table->integer('group_max_players');
            $table->integer('maps_count');
            $table->string('maps');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tournament');
    }
}
