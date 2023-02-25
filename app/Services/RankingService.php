<?php

namespace App\Services;

use App\Enums\MatchGameModeEnum;
use App\Enums\MatchTypeEnum;
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
    public static function calculatePlayerPoints(string $playerName): array|int
    {
        $player = Player::with('actualMatches')->where('playerName', $playerName)->first();

        $player->actualMatches = $player->actualMatches->filter(function ($match) {
            return !$match->isCustomMatch && $match->type !== MatchTypeEnum::AIROYALE ;
        });

        if ($player) {
            $season = Season::where('isCurrentSeason', true)->first();
            $modesPoints = [];
            $mostPoints = [];

            foreach (MatchGameModeEnum::parentModes() as $mode) {
                $matches = $player->actualMatches->filter(function ($match) use ($mode) {
                    if ($mode === MatchGameModeEnum::PARENT_TPP) {
                        return in_array($match->gameMode, MatchGameModeEnum::TppModes()) && $match->type === MatchTypeEnum::OFFICIAL;
                    }

                    if ($mode === MatchGameModeEnum::PARENT_FPP) {
                        return in_array($match->gameMode, MatchGameModeEnum::FppModes())  && $match->type === MatchTypeEnum::OFFICIAL;
                    }

                    return $match->type === MatchTypeEnum::COMPETITIVE;
                });

                $playerMatchesCount = $matches->count();

                if ($playerMatchesCount >= 25) {
                    $calculator = new CalculatorHelper($matches);
                    $calculator = $calculator
                        ->calculateKda()
                        ->calculateKd()
                        ->calculateMediumDamage()
                        ->calculatePercentWins()
                        ->calculatePercentHeadShots()
                        ->calculateRankingPoints();

                    $playerRankingStats = PlayerRankingStats::where('player_id', $player->id)
                        ->where('season_id', $season->id)
                        ->where('type', $mode)
                        ->first();

                    if (!$playerRankingStats) {
                        $playerRankingStats = new PlayerRankingStats();
                    }

                    $playerRankingStats->type = $mode;
                    $playerRankingStats->player_id = $player->id;
                    $playerRankingStats->season_id = $season->id;
                    $playerRankingStats->rang_id = RankingRangEnum::getRang($calculator->points)->id;
                    $playerRankingStats->matches = $playerMatchesCount;
                    $playerRankingStats->wins =  $matches->filter(function ($match) {
                        return $match->winPlace == 1;
                    })->count();
                    $playerRankingStats->points = $calculator->points;
                    $playerRankingStats->percent_wins = $calculator->wins_percent;
                    $playerRankingStats->percent_headshot = $calculator->headshots_percent;
                    $playerRankingStats->kda = $calculator->kda;
                    $playerRankingStats->kd = $calculator->kd;
                    $playerRankingStats->medium_damage = $calculator->medium_damage;
                    $playerRankingStats->save();

                    if (empty($mostPoints)) {
                        $mostPoints = [
                          'type' => $playerRankingStats->type,
                          'points' => $playerRankingStats->points
                        ];
                    } else {
                        if ($mostPoints['points'] < $playerRankingStats->points) {
                            $mostPoints = [
                                'type' => $playerRankingStats->type,
                                'points' => $playerRankingStats->points
                            ];
                        }
                    }

                    $modesPoints[$mode] = $playerRankingStats;
                } else {
                    $modesPoints[$mode] = $playerMatchesCount;
                }
            }
            if (isset($mostPoints['type'])) {
                $modesPoints[$mostPoints['type']]->is_mostType = true;
            }


            return $modesPoints;
        }
    }

    public static function getPlayerStats(string $matchMode, string $playerName): ?PlayerRankingStats
    {
        $player = Player::with('discordRanking')->where('playerName', $playerName)->first();

        if ($player && $player->discordRanking) {
            return $player->discordRanking->where('type', $matchMode)->first();
        }

        return null;
    }
}
