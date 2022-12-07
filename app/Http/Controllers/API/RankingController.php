<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Ranking\IndexRequest;
use App\Models\Player;
use App\Models\PlayerRankingStats;
use App\Models\Season;
use App\Services\PlayerMatchSeasonStatisticService;
use App\Services\PlayerService;
use App\Services\RankingService;
use Illuminate\Http\JsonResponse;

class RankingController
{
    public function index(string $component, int $count)
    {
        switch ($component) {
            case $component === 'adr':
                $component = 'medium_damage';
            default: break;
        }

        $ranking = PlayerRankingStats::with('player')->orderBy($component, 'DESC')
            ->limit($count)->get();

        if ($ranking) {
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

        if (!$player) {
            return response()->json([
                'correct' => false,
                'msg' => 'Gracz nie istnieje.'
            ]);
        }

        if (!$player->canUpdateMatches() || !$player->canUpdateRanking()) {
            return response()->json([
                'correct' => false,
                'msg' => 'Możesz aktualizować swój ranking raz na godzinę.'
            ]);
        }

        if ($player) {
            PlayerMatchSeasonStatisticService::downloadAllPlayerMatches($player, $seasonNumber, true);
            $matchesCount = $player->actualMatches->count();
            if ($matchesCount >= 25) {
                $stats = RankingService::calculatePlayerPoints($playerName);
            } else {
                return response()->json([
                    'correct' => false,
                    'msg' => 'Musisz rozegrać min. 25 meczy, rozegrałeś do tej pory: '.$matchesCount.' meczy.'
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

        $msg = '';

        if (!$stats) {
            $msg = 'Nie odnaleziono gracza w bazie danych lub gracz nie ma ustanowionych statystyk dla aktualnego sezonu.';
        }

        return response()->json([
            'correct' => $stats ? true : false,
            'stats' => $stats ? $stats->toArray() : [],
            'msg' => $msg
        ]);
    }
}
