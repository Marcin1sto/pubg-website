<?php

namespace App\Http\Controllers\API;

use App\Models\Player;
use App\Services\PubgConnector;

class ApiClanController
{
    public function index()
    {
        $clans = Player::whereNotNull('clanId')->where('clanId', '!=', '')->select('clanId')->distinct()->get();
        $clans = $clans->pluck('clanId');

        foreach ($clans as $clan) {
            $connector = new PubgConnector();
            $connector->connect('clans/' . $clan);
            $response = $connector->getData();
            if (!$connector->connectFalse()) {
                $data[] = [
                    [
                        'id' => $response->data->id,
                        'clanName' => $response->data->attributes->clanName,
                        'clanTag' => $response->data->attributes->clanTag,
                        'clanLevel' => $response->data->attributes->clanLevel,
                        'clanMemberCount' => $response->data->attributes->clanMemberCount,
                    ]
                ];
            }
        }

        $response = [
            'correct' => true,
            'data' => $data ?? []
        ];

        return response()->json([
            'correct' => true,
            'data' => $response
        ]);
    }

    public function show(string $clan_id)
    {
        $connector = new PubgConnector();
        $connector->connect('clans/' . $clan_id);

        if (!$connector->connectFalse()) {
            $data = $connector->getData();

            $response = [
                'correct' => true,
                'data' => [
                    'id' => $data->data->id,
                    'clanName' => $data->data->attributes->clanName,
                    'clanTag' => $data->data->attributes->clanTag,
                    'clanLevel' => $data->data->attributes->clanLevel,
                    'clanMemberCount' => $data->data->attributes->clanMemberCount,
                ]
            ];

            return response()->json($response);
        }

        return response()->json(['error' => 'Nie znaleziono klanu.', 'correct' => false], 404);
    }
}
