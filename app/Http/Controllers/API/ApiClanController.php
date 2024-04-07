<?php

namespace App\Http\Controllers\API;

use App\Services\PubgConnector;

class ApiClanController
{
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
