<?php

namespace App\Services;

use App\Models\Player;
use App\Models\PlayerSeasonStatistic;
use App\Models\Season;

class PlayerSeasonStatisticService
{
    public static function updatePlayerSeasonStatistic(string $nickName, ?string $numberSeason)
    {
        if ($numberSeason) {
            $season = Season::where('number', $numberSeason)->first();
        } else {
            $season = Season::where('isCurrentSeason', true)->first();
        }

        $player = Player::where('playerName', $nickName)->first();
        if (!$player) {
            PlayerService::createPlayer($nickName);
            $player = Player::where('playerName', $nickName)->first();
        }

        if ($player->canUpdateSeason()) {
            $connector = new PubgConnector();
            $response = $connector->connect('players/'. $player->playerId.'/seasons/'. $season->api_id.'?filter[gamepad]=false')->getData();
            $playerStatistics = $response->data->attributes->gameModeStats;

            foreach ($playerStatistics as $keyMode => $mode) {
                $playerStatistic = PlayerSeasonStatistic::where('player_id', $player->id)
                    ->where('type', $keyMode);

                if ($numberSeason) {
                    $playerStatistic->where('season_id', $season->id);
                }
                $playerStatistic = $playerStatistic->first();

                $modeObject = !$playerStatistic ? new PlayerSeasonStatistic() : $playerStatistic;
                $modeObject->fill(collect($mode)->toArray());
                $modeObject->type = $keyMode;
                $modeObject->season_id = $season->id;
                $modeObject->player_id = $player->id;
                $modeObject->save();
            }

            $player->update([
                'seasonUpdate' => date('Y-m-d H:i:s')
            ]);
        }
    }
}
