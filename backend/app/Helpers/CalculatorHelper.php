<?php

namespace App\Helpers;

use App\Models\Player;
use Illuminate\Support\Collection;

class CalculatorHelper
{
    public float $kda;
    public float $kd;
    public float $medium_damage;
    public int $points;
    public int $wins_percent;
    public int $headshots_percent;

    public function __construct(
        private Collection $matches,
    )
    {
    }

    public function calculateKda(): static
    {
        $playerMatches = $this->matches;
        $playerMatchesCount = $playerMatches->count();
        $allKills = $playerMatches->sum('kills');
        $allAssists = $playerMatches->sum('assists');
        $winMatchesCount = $playerMatches->filter(function ($match) {
            return $match->winPlace == 1;
        })->count();

        $this->kda = round(($allKills + $allAssists ) / ($playerMatchesCount - $winMatchesCount), 2);

        return $this;
    }

    public function calculateKd(): static
    {
        $playerMatches = $this->matches;
        $allKills = $playerMatches->sum('kills');
        $playerMatchesCount = $playerMatches->count();
        $winMatchesCount = $playerMatches->filter(function ($match) {
            return $match->winPlace == 1;
        })->count();
        $allDeaths = ($playerMatchesCount - $winMatchesCount);

        $this->kd = round(($allKills / $allDeaths), 2);

        return $this;
    }

    public function calculateMediumDamage(): static
    {
        $playerMatches = $this->matches;
        $allDamage = $playerMatches->sum('damageDealt');
        $countMatches = $playerMatches->count();

        $this->medium_damage = (int)($allDamage / $countMatches);

        return $this;
    }

    public function calculateRankingPoints(): static
    {
        $playerMatches = $this->matches;
        $playerMatchesCount = $playerMatches->count();
        $winMatchesCount = $playerMatches->filter(function ($match) {
            return $match->winPlace == 1;
        })->count();
        $winsPerMatches = (int)($winMatchesCount / $playerMatchesCount * 100);
        $allDamage = $playerMatches->sum('damageDealt');
        $damage = round($allDamage / $playerMatchesCount, 2);
        $this->points = (int)(($winsPerMatches * 13 + ($damage * 1.4) + ($this->kda * 120)) / 3);

        return $this;
    }

    public function boostByGameMode(string $mode)
    {
        $playerMatches = $this->matches;
        $playerMatchesCount = $playerMatches->count();

        //=JEŻELI([@matches]<50;1,1;JEŻELI([@matches]<100;1,2;JEŻELI([@matches]>100;1,3;1,5)))
        if ($playerMatchesCount < 50) {
            $percent = 1.1;
        } elseif ($playerMatchesCount < 100) {
            $percent = 1.2;
        } elseif ($playerMatchesCount > 100) {
            $percent = 1.3;
        } else {
            $percent = 1.0;
        }

        if ($mode == 'ranked') {
            $this->points = (int)($this->points ?? 0 * $percent) + 150;
        } else {
            $this->points = (int)($this->points ?? 0 * $percent);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function calculatePercentWins(): static
    {
        $playerMatches = $this->matches;
        $playerMatchesCount = $playerMatches->count();
        $winMatchesCount = $playerMatches->filter(function ($match) {
            return $match->winPlace == 1;
        })->count();

        $this->wins_percent = (int)(($winMatchesCount / $playerMatchesCount) * 100);

        return $this;
    }

    /**
     * @return $this
     */
    public function calculatePercentHeadShots(): static
    {
        $playerMatches = $this->matches;
        $kills = $playerMatches->sum('kills');
        $headshots = $playerMatches->sum('headshotKills');

        $this->headshots_percent = (int)(($headshots / $kills) * 100);

        return $this;
    }

    public static function calculateKdFromMatches($matches): float
    {
        $playerMatches = $matches;
        $allKills = $playerMatches->sum('kills');
        $playerMatchesCount = $playerMatches->count();
        $winMatchesCount = $playerMatches->filter(function ($match) {
            return $match->winPlace == 1;
        })->count();
        $allDeaths = ($playerMatchesCount - $winMatchesCount);

        return round(($allKills / $allDeaths), 2);
    }

    /**
     * @return $this
     */
    public static function calculatePercentWinsFromMatches($matches): float
    {
        $playerMatches = $matches;
        $playerMatchesCount = $playerMatches->count();
        $winMatchesCount = $playerMatches->filter(function ($match) {
            return $match->winPlace == 1;
        })->count();

        return (int)(($winMatchesCount / $playerMatchesCount) * 100);
    }
}
