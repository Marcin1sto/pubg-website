<?php

namespace App\Http\Controllers\API;

use App\Models\Player;
use App\Services\PubgConnector;

class ApiClanController
{
    public function index()
    {
//        $clans = Player::whereNotNull('clanId')->where('clanId', '!=', '')->select('clanId')->distinct()->get();
//        $clans = $clans->pluck('clanId');

//        foreach ($clans as $clan) {
//            $connector = new PubgConnector();
//            $connector->connect('clans/' . $clan);
//            $response = $connector->getData();
//            if (!$connector->connectFalse()) {
//                $data[] = [
//                    [
//                        'id' => $response->data->id,
//                        'clanName' => $response->data->attributes->clanName,
//                        'clanTag' => $response->data->attributes->clanTag,
//                        'clanLevel' => $response->data->attributes->clanLevel,
//                        'clanMemberCount' => $response->data->attributes->clanMemberCount,
//                    ]
//                ];
//            }
//        }

        $data = '{"correct":true,"data":{"correct":true,"data":[[{"id":"clan.8fa7fb703eb84f86bf52e649febaf700","clanName":"Discord_Polska","clanTag":"PLNY","clanLevel":18,"clanMemberCount":95}],[{"id":"clan.2471b9acd91943c78d4055ca0fdc2507","clanName":"FriendsPL","clanTag":"FPL","clanLevel":5,"clanMemberCount":24}],[{"id":"clan.cd6955b3eb3a4d96bc68aaf8072d5da6","clanName":"ReT4Rded-Ch4os","clanTag":"RTOS","clanLevel":13,"clanMemberCount":30}],[{"id":"clan.5390611f957f4f118d60e3db405fcd34","clanName":"Ultimatum","clanTag":"ULT","clanLevel":9,"clanMemberCount":12}],[{"id":"clan.9f7df64781ca45fe8bd9d7e74a7abe36","clanName":"VanillaICE","clanTag":"VICE","clanLevel":15,"clanMemberCount":69}],[{"id":"clan.4dd6efa470fe4cf5a773cd2555ed8196","clanName":"poGROM","clanTag":"GROM","clanLevel":11,"clanMemberCount":21}],[{"id":"clan.f9af606d47d94bccbe93eb02e16ecbd6","clanName":"Green8","clanTag":"G8","clanLevel":13,"clanMemberCount":16}],[{"id":"clan.5e0461aa8c25450c8b4bbc1069d64e3a","clanName":"GigaChadFamilia","clanTag":"GIGA","clanLevel":6,"clanMemberCount":44}]]}}';

//        $response = [
//            'correct' => true,
//            'data' => $data ?? []
//        ];

        return response()->json([
            'correct' => true,
            'data' => json_decode($data)
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
