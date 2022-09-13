<?php

use App\Http\Controllers\API\ApiMatchesController;
use App\Http\Controllers\API\ApiSeasonController;
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
