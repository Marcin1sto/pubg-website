<?php

namespace App\Http\Controllers\API;

use App\Models\Season;
use App\Services\PlayerSeasonStatisticService;

class ApiSeasonController
{
    /**
     * @param string $nickName
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePlayerSeason(string $nickName): \Illuminate\Http\JsonResponse
    {

        $seasonNumber = Season::where('isCurrentSeason', true)->first()->number;
        try {
            PlayerSeasonStatisticService::updatePlayerSeasonStatistic($nickName, $seasonNumber);
        } catch (\Exception $e) {
            return response()->json([
                'correct' => false
            ]);
        }

        return response()->json([
            'correct' => true
        ]);
    }
}
