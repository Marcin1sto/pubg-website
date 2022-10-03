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


    public static function getRang(int $points): RankingRang
    {
        return RankingRang::where('name', self::checkPointsToRang($points))->first();
    }

    private static function checkPointsToRang(int $points)
    {
        switch ($points) {
            case $points > 0 && $points <= 100:
                return self::BRONZE;
            case $points >= 100 && $points <= 200:
                return self::SILVER;
            case $points >= 200 && $points <= 300:
                return self::GOLD;
            case $points >= 300 && $points <= 400:
                return self::PLATINUM;
            case $points >= 400 && $points <= 500:
                return self::DIAMOND;
            case $points >= 500 && $points <= 600:
                return self::MASTER;
            case $points >= 600 && $points <= 700:
                return self::GRANDMASTER;
            case $points >= 700 && $points <= 800:
                return self::CHALLENGER;
            case $points >= 800:
                return self::ELITE;
        }
    }
}
