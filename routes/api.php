<?php

use App\Http\Controllers\API\ApiMatchesController;
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

Route::get('/test', function () {
    return response()->json([
        'working' => true
    ]);
});

Route::get('bot/ranking/index/{count}', [RankingController::class, 'index']);
Route::get('bot/ranking/update/{nickName}', [RankingController::class, 'update']);
Route::get('bot/ranking/stats/{nickName}', [RankingController::class, 'show']);
