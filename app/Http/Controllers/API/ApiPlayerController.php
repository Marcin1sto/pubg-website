<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\PlayerService;
use Illuminate\Http\JsonResponse;

class ApiPlayerController extends Controller
{
    public function verification(string $nickName): JsonResponse
    {
        $player = PlayerService::createPlayer($nickName);

        return response()->json([
            'correct' => !!$player,
            'data' => $player->toArray()
        ]);
    }

}
