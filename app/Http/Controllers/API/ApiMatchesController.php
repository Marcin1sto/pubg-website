<?php

namespace App\Http\Controllers\API;

use App\Models\Player;
use App\Models\Season;
use App\Services\PlayerMatchSeasonStatisticService;
use App\Services\PlayerService;

class ApiMatchesController
{
    /**
     * @param string $nickName
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePlayerMatches(string $nickName): \Illuminate\Http\JsonResponse
    {
        $player = Player::where('playerName', $nickName)->first();

        if (!$player) {
            $service = PlayerService::createPlayer($nickName);

            if ($service) {
                $player = Player::where('playerName', $nickName)->first();
            }
        }
        $seasonNumber = Season::where('isCurrentSeason', true)->first()->number;
        $matches = PlayerMatchSeasonStatisticService::downloadAllPlayerSeasonStatistic($player, $seasonNumber, true);

        if ($matches) {
            return response()->json([
                'correct' => true
            ]);
        }

        return response()->json([
            'correct' => false
        ]);
    }
}
