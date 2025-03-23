<?php

use App\Http\Controllers\API\ApiClanController;
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

Route::get('/player/{id}/game/{game}', [ApiPlayerController::class, 'getPlayerGameStats']);
Route::get('/players', [ApiPlayerController::class, 'index']);
Route::get('/players/{id?}', [ApiPlayerController::class, 'show']);

//Route::get('/{platform}/matches/{nickName}', [ApiMatchesController::class, 'updatePlayerMatches']);
//Route::get('/{platform}/season/{nickName}', [ApiSeasonController::class, 'updatePlayerSeason']);


Route::prefix('bot')->group(function () {
    Route::get('/{platform}/clan/{clan_id}', [ApiClanController::class, 'show']);
    Route::get('/{platform}/clan', [ApiClanController::class, 'index']);
    Route::get('/{platform}/player/verification/{nickname}', [ApiPlayerController::class, 'verification']);
    Route::get('/player/{nickname}', [ApiPlayerController::class, 'show']);
    Route::get('/{platform}/ranking/index/{matchMode}/{component}/{count}', [RankingController::class, 'index']);
    Route::get('/{platform}/ranking/update/{nickName}', [RankingController::class, 'update']);
    Route::get('/{platform}/ranking/stats/{matchMode}/{nickName}', [RankingController::class, 'showOne']);
    Route::get('/{platform}/ranking/stats/{nickName}', [RankingController::class, 'show']);
    Route::get('/{platform}/ranking/ranks', [RankingController::class, 'ranks']);
});
