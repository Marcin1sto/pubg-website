<?php

use App\Models\Ranking\RankingRang;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRankingRanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ranking_ranks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->string('name');
            $table->integer('from')->nullable();
            $table->integer('to')->nullable();
        });

        $ranks = [
            'bronze' => [
                'from' => 0,
                'to' => 100,
            ],
            'silver' => [
                'from' => 100,
                'to' => 200,
            ],
            'gold' => [
                'from' => 200,
                'to' => 300,
            ],
            'platinum' => [
                'from' => 300,
                'to' => 400,
            ],
            'diamond' => [
                'from' => 400,
                'to' => 500,
            ],
            'master' => [
                'from' => 500,
                'to' => 600,
            ],
            'grandmaster' => [
                'from' => 600,
                'to' => 700,
            ],
            'challenger' => [
                'from' => 700,
                'to' => 800,
            ],
            'elite' => [
                'from' => 800,
                'to' => 900,
            ],
        ];

        foreach ($ranks as $key => $rank) {
            $object = new RankingRang();
            $object->name = $key;
            $object->from = $rank['from'];
            $object->to = $rank['to'];
            $object->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ranking_ranks');
    }
}
