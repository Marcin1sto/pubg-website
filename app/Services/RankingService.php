<?php

namespace App\Services;

use App\Enums\RankingRangEnum;
use App\Helpers\CalculatorHelper;
use App\Models\Player;
use App\Models\PlayerRankingStats;
use App\Models\Ranking\RankingRang;
use App\Models\Season;

class RankingService
{
    // Aktualizować co 6h
    /**
     * @param string $playerName
     * @return int
     */
    public static function calculatePlayerPoints(string $playerName): ?PlayerRankingStats
    {
        $player = Player::with('actualMatches')->where('playerName', $playerName)->first();

        $player->actualMatches = $player->actualMatches->filter(function ($match) {
            return $match->type !== 'normal-squad';
        });

        if ($player && $player->actualMatches->count() >= 25) {
            $playerMatches = $player->actualMatches;

            $calculator = new CalculatorHelper($player);
            $calculator = $calculator
                ->calculateKda()
                ->calculateKd()
                ->calculateMediumDamage()
                ->calculatePercentWins()
                ->calculatePercentHeadShots()
                ->calculateRankingPoints();
            $playerMatchesCount = $playerMatches->count();

            if ($playerMatchesCount > 0) {
                $playerRankingStats = PlayerRankingStats::where('player_id', $player->id)->first();

                if (!$playerRankingStats) {
                    $playerRankingStats = new PlayerRankingStats();
                }

                $season = Season::where('isCurrentSeason', true)->first();

                $playerRankingStats->player_id = $player->id;
                $playerRankingStats->season_id = $season->id;
                $playerRankingStats->rang_id = RankingRangEnum::getRang($calculator->points)->id;
                $playerRankingStats->matches = $playerMatchesCount;
                $playerRankingStats->wins =  $playerMatches->filter(function ($match) {
                    return $match->winPlace == 1;
                })->count();
                $playerRankingStats->points = $calculator->points;
                $playerRankingStats->percent_wins = $calculator->wins_percent;
                $playerRankingStats->percent_headshot = $calculator->headshots_percent;
                $playerRankingStats->kda = $calculator->kda;
                $playerRankingStats->kd = $calculator->kd;
                $playerRankingStats->medium_damage = $calculator->medium_damage;
                $playerRankingStats->save();

                return $playerRankingStats;
            }
        }

        return null;
    }

    public static function getPlayerStats(string $playerName): ?PlayerRankingStats
    {
        $player = Player::with('actualMatches')->where('playerName', $playerName)->first();

        if ($player) {
            return PlayerRankingStats::where('player_id', $player->id)->first();
        }

        return null;
    }
}
