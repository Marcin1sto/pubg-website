<?php

use App\Http\Controllers\API\ApiMatchesController;
use App\Http\Controllers\API\ApiPlayerController;
use App\Http\Controllers\API\ApiSeasonController;
use App\Http\Controllers\API\RankingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('matches/{nickName}', [ApiMatchesController::class, 'updatePlayerMatches']);
Route::get('season/{nickName}', [ApiSeasonController::class, 'updatePlayerSeason']);


Route::prefix('bot')->group(function () {
    Route::get('/clan/{clan_id}', [\App\Http\Controllers\API\ApiClanController::class, 'show']);
    Route::get('/player/verification/{nickname}', [ApiPlayerController::class, 'verification']);
    Route::get('/player/{nickname}', [ApiPlayerController::class, 'show']);
    Route::get('/ranking/index/{matchMode}/{component}/{count}', [RankingController::class, 'index']);
    Route::get('/ranking/update/{nickName}', [RankingController::class, 'update']);
    Route::get('/ranking/stats/{matchMode}/{nickName}', [RankingController::class, 'showOne']);
    Route::get('/ranking/stats/{nickName}', [RankingController::class, 'show']);
    Route::get('/ranking/ranks', [RankingController::class, 'ranks']);
});
