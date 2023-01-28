<?php

namespace App\Http\Controllers;

use App\Enums\MatchGameModeEnum;
use App\Models\PlayerRankingStats;
use App\Models\Season;
use App\Services\RankingService;

class RankingController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('ranking', ['mode' => null]);
    }

    /**
     * For specific GameMode
     * @param string $modeType
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function show(string $modeType)
    {
        if (!in_array($modeType, MatchGameModeEnum::parentModes())) {
            return redirect('/ranking');
        }

        $season = Season::where('isCurrentSeason', true)->first();
        $ranking = PlayerRankingStats::with(['player', 'rang'])->where('type', $modeType)->where('season_id', $season->id)->get()->sortByDesc('points');
        $top_3 = $ranking->slice(0, 3)->values();

        return view('ranking', ['mode' => $modeType, 'ranking' => $ranking->skip(3)->values(), 'top3' => $top_3]);
    }
}
