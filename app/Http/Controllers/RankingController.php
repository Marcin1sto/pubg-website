<?php

namespace App\Http\Controllers;

use App\Models\PlayerRankingPoint;
use App\Services\RankingService;

class RankingController extends Controller
{
    public function index()
    {
        $ranking = PlayerRankingPoint::with('player')->get()->sortByDesc('points');
        $top_3 = $ranking->slice(0, 3)->values();

        return view('ranking', ['ranking' => $ranking->skip(3)->values(), 'top3' => $top_3]);
    }
}
