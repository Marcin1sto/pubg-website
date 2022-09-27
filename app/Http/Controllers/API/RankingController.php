<?php

namespace App\Http\Controllers\API;

use App\Models\Player;
use App\Models\PlayerRankingStats;
use App\Models\Season;
use App\Services\PlayerMatchSeasonStatisticService;
use App\Services\PlayerService;
use App\Services\RankingService;
use Illuminate\Http\JsonResponse;

class RankingController
{
    public function index(int $count)
    {
        $ranking = PlayerRankingStats::with('player')->limit($count)->get()->sortByDesc('points');

        if ($ranking->count() > 3) {
            return response()->json([
                'correct' => true,
                'ranking' => $ranking->toArray()
            ]);
        }

        return response()->json([
            'correct' => false
        ]);
    }

    /**
     * Update user ranking from matches
     *
     * @param string $playerName
     * @return JsonResponse
     */
    public function update(string $playerName): JsonResponse
    {
        $seasonNumber = Season::where('isCurrentSeason', true)->first()?->number;
        PlayerService::createPlayer($playerName);
        $player = Player::where('playerName', $playerName)->first();

        if ($player) {
            $matches = PlayerMatchSeasonStatisticService::downloadAllPlayerSeasonStatistic($player, $seasonNumber, true);
            if (count($matches) >= 25) {
                $stats = RankingService::calculatePlayerPoints($playerName);
            } else {
                return response()->json([
                    'correct' => false,
                    'msg' => 'Musisz rozegrać min. 25 meczy.'
                ]);
            }
        } else {
            return response()->json([
                'correct' => false,
                'msg' => 'Możesz zaktualizować swój ranking raz na godzinę.'
            ]);
        }

        return response()->json([
            'correct' => true,
            'stats' => $stats
        ]);
    }

    /**
     * Show player statistic from matches
     *
     * @param string $playerName
     * @return JsonResponse
     */
    public function show(string $playerName): JsonResponse
    {
        $stats = RankingService::getPlayerStats($playerName);
        return response()->json([
            'correct' => $stats ? true : false,
            'stats' => $stats ? $stats->toArray() : []
        ]);
    }
}
