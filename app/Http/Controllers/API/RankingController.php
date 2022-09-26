<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PlayerRankingStats;
use App\Services\RankingService;

class RankingController extends Controller
{
    public function index()
    {
        $ranking = PlayerRankingStats::with('player')->get()->sortByDesc('points');
        $top_3 = $ranking->slice(0, 3)->values();

        return view('ranking', ['ranking' => $ranking->skip(3)->values(), 'top3' => $top_3]);
    }

    public function updatePlayer(string $nickName)
    {
        $stats = RankingService::calculatePlayerPoints($nickName);

        return response()->json($stats->toArray());
    }
}
