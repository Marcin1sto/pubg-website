<?php

namespace App\Services;

use App\Enums\PlatformEnum;
use App\Models\Player;
use App\Models\PlayerPlatform;

class PlayerService
{
    private PubgConnector $connector;

    public function __construct()
    {
        $this->connector = new PubgConnector();
    }

    /**
     * @param string $nickName
     * @return bool
     */
    public static function createPlayer(string $nickName, $platform = 'steam'): ?Player
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
                    $player->clanId = $response->attributes->clanId;
                    $player->save();
                }

                return $player;
            }
        }

        self::updatePlayerClanID($player, $platform);

        return $player;
    }

    public static function updatePlayerName(Player $player): ?Player
    {
        $platforms = PlatformEnum::toArray();

        foreach ($platforms as $platform) {
            $playerPlatform = PlayerPlatform::where('player_id', $player->id)->where('platform', $platform)->first();

            $connector = new PubgConnector();
            $connector->setPlatform($platform);
            $connector->connect('players/' . $player->playerId);

            if (!$connector->connectFalse()) {
                $response = $connector->getData()->data;

                if ($playerPlatform) {
                    if ($response->type = 'player') {
                        $playerPlatform->playerName = $response->attributes->name;
                        $playerPlatform->save();
                    }
                } else {
                    if ($response->type = 'player') {
                        $playerPlatform = new PlayerPlatform();
                        $playerPlatform->player_id = $player->id;
                        $playerPlatform->platform = $platform;
                        $playerPlatform->playerName = $response->attributes->name;
                        $playerPlatform->clanId = $response->attributes->clanId;
                        $playerPlatform->save();
                    }
                }
            }
        }

        return null;
    }

    public static function updatePlayerClanID(Player $player, string $platform = 'steam'): ?Player
    {
        $connector = new PubgConnector();
        $connector->setPlatform($platform);
        $connector->connect('players/' . $player->playerId);

        if (!$connector->connectFalse()) {
            $response = $connector->getData()->data;

            if ($response->type = 'player') {
                $playerPlatform = PlayerPlatform::where('player_id', $player->id)->where('platform', $platform)->first();

                if ($playerPlatform) {
                    $playerPlatform->clanId = $response->attributes->clanId;
                    $playerPlatform->save();
                } else {
                    $playerPlatform = new PlayerPlatform();
                    $playerPlatform->player_id = $player->id;
                    $playerPlatform->platform = $platform;
                    $playerPlatform->playerName = $response->attributes->name;
                    $playerPlatform->clanId = $response->attributes->clanId;
                    $playerPlatform->save();
                }
            }

            return $player;
        }

        return null;
    }
}
