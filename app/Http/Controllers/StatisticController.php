<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\PlayerMatchStatistic;
use App\Models\Season;
use App\Services\PlayerMatchSeasonStatisticService;
use App\Services\PlayerSeasonStatisticService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class StatisticController extends Controller
{
    public function index()
    {
        $players = Player::all();

        return view('stats')->with(['players' => $players]);
    }

    /**
     * @param string $playerName
     * @return Factory|View|Application
     */
    public function show(string $playerName): Factory|View|Application
    {
        $numberSeason = $season = Season::where('isCurrentSeason', true)->first()->number;

        PlayerSeasonStatisticService::updatePlayerSeasonStatistic($playerName, $numberSeason);
        $player = Player::with(['actualSeason'])->where('playerName', $playerName)->first();
        PlayerMatchSeasonStatisticService::downloadAllPlayerSeasonStatistic($player, $numberSeason);

        $season = $player->actualSeason->groupBy('type');

        return view('playerStats')->with([
            'player' => $player,
            'season' => $season,
            'matches' => $player->matches()->paginate()
        ]);
    }
}
