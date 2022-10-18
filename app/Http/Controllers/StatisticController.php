<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\PlayerMatchStatistic;
use App\Models\Season;
use App\Services\PlayerMatchSeasonStatisticService;
use App\Services\PlayerSeasonStatisticService;
use App\Services\PlayerService;
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
        PlayerService::createPlayer($playerName);

        $player = Player::with(['actualSeason', 'discordRanking', 'matches'])->where('playerName', $playerName)->first();

        $season = $player->actualSeason->groupBy('type');

        dd($player->matches()->orderBy('season_id', 'ASC')->get()->toArray());

        return view('playerStats')->with([
            'player' => $player,
            'season' => $season,
            'countMatches' => $player->matches->count(),
            'matches' => $player->matches()->orderBy('season_id', 'ASC')->paginate()
        ]);
    }
}
