<?php

namespace App\Http\Controllers\API;

use App\Models\Clan;
use App\Models\PlayerPlatform;
use App\Services\ClanService;

class ApiClanController
{
    public function index(string $platform): \Illuminate\Http\JsonResponse
    {
        $playersClans = PlayerPlatform::whereNotNull('clanId')->select('clanId')->distinct()->get();
        $playersClans = $playersClans->pluck('clanId');
        $clans = Clan::all()->pluck('clanId');

        $newClans = $playersClans->diff($clans);
        if (!$newClans->isEmpty()) {
            foreach ($newClans as $clan) {
                ClanService::createClan($clan);
            }
        }

        return response()->json([
            'correct' => true,
            'data' => Clan::all()->toArray() ?? []
        ]);
    }

    public function show(string $clan_id): \Illuminate\Http\JsonResponse
    {
        $clan = Clan::where('clanId', $clan_id)->first();

        if ($clan) {
            return response()->json([
                'correct' => true,
                'data' => $clan->toArray()
            ]);
        }

        return response()->json(['error' => 'Nie znaleziono klanu.', 'correct' => false], 404);
    }
}
