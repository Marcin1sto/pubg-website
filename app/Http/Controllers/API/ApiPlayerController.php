<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Services\PlayerService;
use Illuminate\Http\JsonResponse;

class ApiPlayerController extends Controller
{
    public function verification(string $nickName): JsonResponse
    {
        $player = PlayerService::createPlayer($nickName);

        return response()->json([
            'correct' => !!$player,
            'data' => $player?->toArray(),
            'msg' => !$player ? 'Nie istnieje gracz z takim nickname!' : 'Zostałeś poprawnie zweryfikowany.'
        ]);
    }

    public function show(string $nickName): JsonResponse
    {
        $player = Player::where('playerName', $nickName)->first();

        return response()->json([
            'correct' => !!$player,
            'data' => $player?->toArray(),
        ]);
    }

}
