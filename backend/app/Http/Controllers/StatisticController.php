<?php

namespace App\Http\Controllers;

use App\Models\Player;
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

        if ($player) {
            $season = $player->actualSeason->groupBy('type');

            return view('playerStats')->with([
                'correct' => true,
                'player' => $player,
                'season' => $season,
                'countMatches' => $player->matches->count(),
                'matches' => $player->matches()->paginate()
            ]);
        }

        return view('playerStats')->with([
            'correct' => false,
            'player' => null,
            'season' => null,
            'countMatches' => null,
            'matches' => null
        ]);
    }
}
