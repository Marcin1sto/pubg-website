<?php

namespace App\Http\Controllers\API;

use App\Enums\MatchGameModeEnum;
use App\Enums\MatchTypeEnum;
use App\Http\Requests\Ranking\IndexRequest;
use App\Models\Player;
use App\Models\PlayerRankingStats;
use App\Models\Ranking\RankingRang;
use App\Models\Season;
use App\Services\PlayerMatchSeasonStatisticService;
use App\Services\PlayerService;
use App\Services\RankingService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\ErrorHandler\Debug;

class RankingController
{
    private RankingService $rankingService;

    public function __construct()
    {
        $this->rankingService = new RankingService();
    }

    public function index(string $matchMode, string $component, int $count): JsonResponse
    {
        $ranking = $this->rankingService->getRanking($matchMode, $component, $count);

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
        $season = Season::where('isCurrentSeason', true)->first();
        PlayerService::createPlayer($playerName);
        $player = Player::where('playerName', $playerName)->first();

        $bannedPlayers = ['UFO_Oumuamua'];

        if (in_array($playerName, $bannedPlayers)) {
            return response()->json([
                'correct' => false,
                'msg' => 'Gracz nie ma uprawnień do rankingowania się.'
            ]);
        }

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

        PlayerMatchSeasonStatisticService::downloadAllPlayerMatches($player, $season?->number, true);

        $stats = RankingService::calculatePlayerPoints($playerName);

        foreach (MatchGameModeEnum::parentModes() as $mode) {
            if (isset($stats[$mode]) && is_int($stats[$mode])) {
                $stats[$mode] = [
                    'correct' => false,
                    'msg' => 'Musisz rozegrać min. 25 meczy, rozegrałeś do tej pory: ' . $stats[$mode] . ' meczy w trybie ' . $mode . '.'
                ];
            }
        }

        return response()->json([
            'correct' => true,
            'stats' => $stats
        ]);
    }

    /**
     * Show player statistic from matches
     *
     * @param string $matchMode
     * @param string $playerName
     * @return JsonResponse
     */
    public function show(string $matchMode, string $playerName): JsonResponse
    {
        $stats = RankingService::getPlayerStats($matchMode, $playerName);

        if (!$stats) {
            $msg = 'Nie odnaleziono gracza w bazie danych lub gracz nie ma ustanowionych statystyk dla aktualnego sezonu w trybie ' . $matchMode . '.';
        }

        return response()->json([
            'correct' => $stats ? true : false,
            'stats' => $stats ? $stats->toArray() : [],
            'msg' => $msg ?? null
        ]);
    }

    /**
     * @return mixed
     */
    public function ranks(): mixed
    {
        $ranks = [];
        foreach (RankingRang::all() as $rang) {
            $rang->name = ucfirst($rang->name);
            $ranks[] = $rang;
        }

        return response()->json($ranks);
    }
}
