<?php

namespace App\Http\Controllers;

use App\Models\PlayerMatchStatistic;
use App\Models\Season;
use App\Models\Tournament\Tournament;

class HomeController
{
    public function index() {
        $actualSeason = Season::where('isCurrentSeason', true)->first();
        $matches = PlayerMatchStatistic::select(['kills', 'winPlace'])->get();

        return view('index', [
            'players' => \App\Models\Player::all()->count(),
            'season_number' => $actualSeason->number,
            'allMatches' => $matches->count(),
            'allKills' => $matches->sum('kills'),
            'allWins' => $matches->filter(function ($match) {
                return $match->winPlace === 1;
            })->count(),
            'events' => Tournament::all()
        ]);
    }
}
