<?php

namespace App\Http\Controllers;

use App\Models\PlayerRankingStats;
use App\Services\RankingService;

class RankingController extends Controller
{
    public function index()
    {
        $ranking = PlayerRankingStats::with(['player', 'rang'])->get()->sortByDesc('points');
        $top_3 = $ranking->slice(0, 3)->values();

        return view('ranking', ['ranking' => $ranking->skip(3)->values(), 'top3' => $top_3]);
    }
}
