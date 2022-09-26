<?php

namespace App\Services;

use App\Models\Player;

class PlayerService
{
    /**
     * @param string $nickName
     * @return bool
     */
    public static function createPlayer(string $nickName): ?Player
    {
        $player = Player::where('playerName', $nickName)->first();

        if (!$player) {
            $connector = new PubgConnector();
            $connector->connect('players?filter[playerNames]=' . $nickName);

            if (!$connector->connectFalse()) {
                $response = $connector->getData()->data[0];

                if ($response->type = 'player') {
                    $player = new Player();
                    $player->playerId = $response->id;
                    $player->playerName = $response->attributes->name;
                    $player->save();
                }

                return $player;
            }
        }

        return null;
    }
}
