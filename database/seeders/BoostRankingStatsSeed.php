<?php

namespace Database\Seeders;

use App\Enums\MatchGameModeEnum;
use App\Models\Ranking\BoostRankingStat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BoostRankingStatsSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ranked = new BoostRankingStat();
        $ranked->fill([
            'stat_type' => MatchGameModeEnum::PARENT_RANKED,
            'count' => 1,
        ]);
        $ranked->save();

        $tpp = new BoostRankingStat();
        $tpp->fill([
            'stat_type' => MatchGameModeEnum::PARENT_TPP,
            'count' => 1,
        ]);
        $tpp->save();

        $fpp = new BoostRankingStat();
        $fpp->fill([
            'stat_type' => MatchGameModeEnum::PARENT_FPP,
            'count' => 1,
        ]);
        $fpp->save();
    }
}
