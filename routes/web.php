<?php

use App\Http\Controllers\RankingController;
use App\Http\Controllers\StatisticController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $matches = \App\Models\PlayerMatchStatistic::all();
    $data = [
        'allMatches' => $matches->count(),
        'allKills' => $matches->sum('kills'),
        'allAssists' => $matches->sum('assists'),
        'rideDistance' => round($matches->sum('rideDistance') / 100, 1),
        'swimDistance' => round($matches->sum('swimDistance') / 100, 1),
        'walkDistance' => round($matches->sum('walkDistance') / 100, 1),
        'allWins' => $matches->filter(function ($match) {
            return $match->winPlace == 1;
        })->count(),
    ];

    return view('index');
});

Route::get('/ranking', [RankingController::class, 'index']);
Route::get('/stats', [StatisticController::class, 'index']);
Route::get('/stats/{playerName}', [StatisticController::class, 'show']);
