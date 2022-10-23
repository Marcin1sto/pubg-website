<?php

namespace App\Helpers;

use App\Models\Player;

class CalculatorHelper
{
    public float $kda;
    public float $kd;
    public float $medium_damage;
    public int $points;
    public int $wins_percent;
    public int $headshots_percent;

    public function __construct(private Player $player)
    {
    }

    public function calculateKda(): static
    {
        $playerMatches = $this->player->actualMatches;
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
        $playerMatches = $this->player->actualMatches;
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
        $playerMatches = $this->player->actualMatches;
        $allDamage = $playerMatches->sum('damageDealt');
        $countMatches = $playerMatches->count();

        $this->medium_damage = (int)($allDamage / $countMatches);

        return $this;
    }

    public function calculateRankingPoints(): static
    {
        $playerMatches = $this->player->actualMatches;
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

    /**
     * @return $this
     */
    public function calculatePercentWins(): static
    {
        $playerMatches = $this->player->actualMatches;
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
        $playerMatches = $this->player->actualMatches;
        $kills = $playerMatches->sum('kills');
        $headshots = $playerMatches->sum('headshotKills');

        $this->headshots_percent = (int)(($headshots / $kills) * 100);

        return $this;
    }
}
