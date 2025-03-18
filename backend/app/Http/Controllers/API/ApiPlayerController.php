<?php

namespace App\Http\Controllers\API;

use App\Enums\GamesEnum;
use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Services\PlayerService;
use Illuminate\Http\JsonResponse;

class ApiPlayerController extends Controller
{
    /**
     * @param string $nickName
     * @return JsonResponse
     */
    public function verification(string $nickName): JsonResponse
    {
        $player = PlayerService::createPlayer($nickName);

        return response()->json([
            'correct' => !!$player,
            'data' => $player?->toArray(),
            'msg' => !$player ? 'Nie istnieje gracz z takim nickname!' : 'Zostałeś poprawnie zweryfikowany.'
        ]);
    }

    /**
     * @param string $nickName
     * @return JsonResponse
     */
    public function show(string $discordId): JsonResponse
    {
        $player = Player::where('discord_id', $discordId)->first();

        return response()->json([
            'correct' => !!$player,
            'data' => $player?->toArray(),
        ]);
    }

    public function getPlayersByGame(?string $game = null)
    {
        if ($game && !in_array($game, GamesEnum::values())) {
            return response()->json([
                'correct' => false,
                'msg' => 'Niepoprawna nazwa gry!'
            ]);
        }

        $players = Player::all();

        return response()->json([
            'correct' => !!$players,
            'data' => $players?->toArray(),
        ]);
    }
}
