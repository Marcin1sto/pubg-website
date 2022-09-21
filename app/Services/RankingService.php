<?php

namespace App\Services;

use App\Models\Player;
use App\Models\PlayerRankingPoint;
use App\Models\Season;

class RankingService
{
    // Aktualizować co 6h
    /**
     * @param string|Player $playerName
     * @return int
     */
    public static function calculatePlayerPoints(string|Player $playerName): int
    {
        if (!is_string($playerName)) {
            $player = $playerName;
        } else {
            $player = Player::with('actualMatches')->where('playerName', $playerName)->first();
        }

        $playerMatches = $player->actualMatches;
        $playerMatchesCount = $playerMatches->count();

        if ($playerMatchesCount > 0) {
            $allKills = $playerMatches->sum('kills');
            $allAssists = $playerMatches->sum('assists');
            $winMatchesCount = $playerMatches->filter(function ($match) {
                return $match->winPlace == 1;
            })->count();
            $kda = round(($allKills + $allAssists ) / ($playerMatchesCount - $winMatchesCount), 2);
            $allDamage = $playerMatches->sum('damageDealt');
            $damage = round($allDamage / $playerMatchesCount, 2);
            $winsPerMatches = (int)($winMatchesCount / $playerMatchesCount * 100);

            $playerPoints = PlayerRankingPoint::where('player_id', $player->id)->first();

            $points = (int)(($winsPerMatches * 13 + ($damage * 1.4) + ($kda * 120)) / 3);

            if ($playerPoints) {
                $playerPoints->update(['points' => $points]);
            } else {
                $season = Season::where('isCurrentSeason', true)->first();

                $playerPoints = new PlayerRankingPoint();
                $playerPoints->player_id = $player->id;
                $playerPoints->season_id = $season->id;
                $playerPoints->points = $points;
                $playerPoints->save();
            }

            return $points;
        }

        return 0;
    }
}
