<?php

use App\Http\Controllers\RankingController;
use App\Http\Controllers\StatisticController;
use App\Models\Season;
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
    $actualSeason = Season::where('isCurrentSeason', true)->first();
    $matches = \App\Models\PlayerMatchStatistic::select(['kills', 'winPlace'])->get();
    $data = [
        'players' => \App\Models\Player::all()->count(),
        'season_number' => $actualSeason->number,
        'allMatches' => $matches->count(),
        'allKills' => $matches->sum('kills'),
        'allWins' => $matches->filter(function ($match) {
            return $match->winPlace === 1;
        })->count(),
        'events' => \App\Models\Tournament\Tournament::all()
    ];

    return view('index', $data);
});

Route::get('/ranking', [RankingController::class, 'index']);
Route::get('/ranking/{modeType}', [ RankingController::class, 'show'])->name('ranking.type');
Route::get('/tournament', [RankingController::class, 'index']);
Route::get('/stats', [StatisticController::class, 'index']);
Route::get('/stats/{playerName}', [StatisticController::class, 'show']);
