<?php

namespace App\Services;

use App\Models\Player;

class PlayerService
{
    /**
     * @param string $nickName
     * @return bool
     */
    public static function createPlayer(string $nickName): bool
    {
        $connector = new PubgConnector();
        $connector->connect('players?filter[playerNames]=' . $nickName);
        $response = $connector->getData()->data[0];

        $player = Player::where('playerName', $nickName)->first();

        if (!$player && $response->type = 'player') {
            $player = new Player();
            $player->playerId = $response->id;
            $player->playerName = $response->attributes->name;
            $player->save();

            return true;
        }

        return false;
    }
}
