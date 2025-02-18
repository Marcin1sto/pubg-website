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

//Route::get('/', function () {
//    $actualSeason = Season::where('isCurrentSeason', true)->first();
//    $matches = \App\Models\AllPubgPlayersStatistic::all()->first();
//    $data = [
//        'players' => $matches->count_players,
//        'season_number' => $actualSeason->number,
//        'allMatches' => $matches->count_matches,
//        'allKills' => $matches->count_kills,
//        'allWins' => $matches->count_wins,
////        'events' => \App\Models\Tournament\Tournament::all()
//    ];
//
//    return view('index', $data);
//});
//
//Route::get('/ranking', [RankingController::class, 'index']);
//Route::get('/ranking/{modeType}', [ RankingController::class, 'show'])->name('ranking.type');
//Route::get('/tournament', [RankingController::class, 'index']);
//Route::get('/stats', [StatisticController::class, 'index']);
//Route::get('/stats/{playerName}', [StatisticController::class, 'show']);
