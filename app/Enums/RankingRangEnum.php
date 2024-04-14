<?php

namespace App\Enums;

use App\Models\Ranking\RankingRang;

class RankingRangEnum
{
    const BRONZE = 'bronze';
    const SILVER = 'silver';
    const GOLD = 'gold';
    const PLATINUM = 'platinum';
    const DIAMOND = 'diamond';
    const MASTER = 'master';
    const GRANDMASTER = 'grandmaster';
    const CHALLENGER = 'challenger';
    const ELITE = 'elite';


    public static function getRang(int $points): ?RankingRang
    {
//        dd(RankingRang::where('from', '>=', $points)->where('to', '>=', $points)->first());
        return RankingRang::where('from', '>=', $points)->where('to', '>=', $points)->first();
    }

    private static function checkPointsToRang(int $points)
    {
        switch ($points) {
            case $points > 0 && $points <= 99:
                return self::BRONZE;
            case $points >= 100 && $points <= 199:
                return self::SILVER;
            case $points >= 200 && $points <= 299:
                return self::GOLD;
            case $points >= 300 && $points <= 399:
                return self::PLATINUM;
            case $points >= 400 && $points <= 499:
                return self::DIAMOND;
            case $points >= 500 && $points <= 599:
                return self::MASTER;
            case $points >= 600 && $points <= 699:
                return self::GRANDMASTER;
            case $points >= 700 && $points <= 799:
                return self::CHALLENGER;
            case $points >= 800:
                return self::ELITE;
        }
    }
}
