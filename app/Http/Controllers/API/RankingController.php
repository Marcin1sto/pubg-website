<?php

namespace App\Http\Controllers\API;

use App\Models\Player;
use App\Models\Season;
use App\Services\PlayerMatchSeasonStatisticService;
use App\Services\RankingService;

class RankingController
{
    public function update(string $playerName)
    {
        $seasonNumber = Season::where('isCurrentSeason', true)->first()?->number;
        $player = Player::where('playerName', $playerName)->first();

        if ($player->canUpdateMatches()) {
            PlayerMatchSeasonStatisticService::downloadAllPlayerSeasonStatistic($player, $seasonNumber, true);
        } else {
            return response()->json([
                'correct' => false,
                'msg' => 'Możesz zaktualizować swój ranking raz na godzinę.'
            ]);
        }

        $points = RankingService::calculatePlayerPoints($player);

        return response()->json([
            'correct' => true,
            'points' => $points
        ]);
    }
}
