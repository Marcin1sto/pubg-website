<?php

namespace App\Services;

use App\Models\Clan;

class ClanService
{
    private PubgConnector $connector;

    public function __construct()
    {
        $this->connector = new PubgConnector();
    }

    /**
     * @param string $clanName
     * @return bool
     */
    public static function createClan(string $clanId): ?Clan
    {
        $clan = Clan::where('clanId', $clanId)->first();

        if (!$clan) {
            $connector = new PubgConnector();
            $connector->connect('clans/' . $clanId);

            if (!$connector->connectFalse()) {
//                dd($connector->getData()->data);
                $response = $connector->getData()->data;

                if ($response->type = 'clan') {
                    $clan = new Clan();
                    $clan->clanId = $response->id;
                    $clan->clanName = $response->attributes->clanName;
                    $clan->clanTag = $response->attributes->clanTag;
                    $clan->clanLevel = $response->attributes->clanLevel;
                    $clan->clanMemberCount = $response->attributes->clanMemberCount;
                    $clan->clanPlatform = $connector->getPlatform();
                    $clan->save();
                }

                return $clan;
            }
        }

        return $clan;
    }
}
