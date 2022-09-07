<?php

namespace App\Http\Controllers;

use App\Models\PlayerRankingPoint;

class RankingController extends Controller
{
    public function index()
    {
        $ranking = PlayerRankingPoint::with('player')->get()->sortByDesc('points');
        $top_3 = $ranking->slice(0, 3);

        return view('ranking', ['ranking' => $ranking, 'top3' => $top_3]);
    }
}
