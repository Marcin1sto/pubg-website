<?php

namespace App\Services;

use App\Models\Player;
use App\Models\PlayerMatchStatistic;
use App\Models\Season;
use Illuminate\Database\Eloquent\Collection;

class PlayerMatchSeasonStatisticService
{
    /**
     * @param Player $player
     * @param string|null $seasonNumber
     * @param bool $saveMatches
     * @return array
     */
    public static function downloadAllPlayerMatches(
        Player $player,
        ?string $seasonNumber = null,
        bool $saveMatches = false,
        bool $force = true
    ): array|Collection
    {
        if ($player->canUpdateMatches($force)) {
            if ($seasonNumber) {
                $actualSeason = Season::where('number', $seasonNumber)->first();
            }

            if (!isset($actualSeason)) {
                $actualSeason = Season::where('isCurrentSeason', true)->first();
            }

            $beforeSeason = Season::where('number', $actualSeason->number - 1)->first();

            $playerId = $player->games()->where('player_id', $player->id)->value('api_player_id');

            $connector = new PubgConnector();
            $last7daysMatches = $connector->connect('players?filter[playerIds]='.$playerId);
            if (!$connector->connectFalse()) {
//                if (!empty($last7daysMatches->getData()->data[0]->attributes->clanId)) {
//                    $player->update([
//                        'clanId' => $last7daysMatches->getData()->data[0]->attributes->clanId
//                    ]);
//                }

                $last7daysMatches = $last7daysMatches->getData()
                    ->data[0]->relationships->matches->data;


                $allMatchesPlayer = [];

                foreach ($last7daysMatches as $key => $match) {
                    $matchDb = PlayerMatchStatistic::where('match_id', $match->id)->where('player_id', $player->id)->first();
//                    $matchConnector = new PubgConnector();
//                    $matchResponse = $matchConnector->connect('matches/'.$match->id);

                    if (!$matchDb) {
                        $matchConnector = new PubgConnector();
                        $matchResponse = $matchConnector->connect('matches/'.$match->id);

                        if (!$matchResponse->connectFalse()) {

                            $matchResponse = $matchResponse->getData();
                            $players = array_filter($matchResponse->included, function ($value) {
                                return $value->type === 'participant';
                            });
                            $playerMatch = array_values(array_filter($players, function ($value) use ($playerId) {
                                $matchPlayerId = $value->attributes->stats->playerId;

                                return $matchPlayerId &&
                                    $value->type == 'participant' &&
                                    $matchPlayerId == $playerId;
                            }, ARRAY_FILTER_USE_BOTH))[0];

                            $playerMatch = json_decode(json_encode($playerMatch), true);

                            if (date('Y-m-d:H:i:s', strtotime($matchResponse->data->attributes->createdAt)) < $actualSeason->created_at) {
                                $seasonId = $beforeSeason->id;
                            } else {
                                $seasonId = $actualSeason->id;
                            }

                            $playerMatch['match_uid'] = $matchResponse->data->id;
                            $playerMatch['attributes']['stats']['gameMode'] = $matchResponse->data->attributes->gameMode;
                            $playerMatch['attributes']['stats']['type'] = $matchResponse->data->attributes->matchType;
                            $playerMatch['attributes']['stats']['mapName'] = $matchResponse->data->attributes->mapName;
                            $playerMatch['attributes']['stats']['isCustomMatch'] = $matchResponse->data->attributes->isCustomMatch;
                            $playerMatch['attributes']['stats']['played_at'] = date('Y-m-d H:i:s', strtotime($matchResponse->data->attributes->createdAt));
                            $playerMatch['attributes']['stats']['season_id'] = $seasonId;
                            $allMatchesPlayer[$key] = (array)$playerMatch;
                        }
                    }
                }

                if ($saveMatches) {
                    foreach ($allMatchesPlayer as $match) {
                        $matchDB = PlayerMatchStatistic::where('match_id', $match['id'])->where('player_id', $player->id)->first();
                        $statistics = $match['attributes']['stats'];

                        if (!$matchDB) {
                            $newMatch = new PlayerMatchStatistic();
                            $newMatch->fill(collect($statistics)->except('playerId')->toArray());
                            $newMatch->match_id = $match['match_uid'];
                            $newMatch->type = $match['attributes']['stats']['type'] === 'seasonal' ? 'official' : $match['attributes']['stats']['type'];
                            $newMatch->player_id = $player->id;
                            $newMatch->save();
                        }
                    }

                    if (!$force) {
                        $player->update([
                            'matchesUpdate' => date('Y-m-d H:i:s')
                        ]);
                    }

                    return PlayerMatchStatistic::where('player_id', $player->id)->get();
                }

                if (!$force) {
                    $player->update([
                        'matchesUpdate' => date('Y-m-d H:i:s')
                    ]);
                }

                return $allMatchesPlayer;
            }
        } else {
            return ['status' => 'error', 'message' => 'You can update matches after '.Player::DELAY_TIME.' hours'];
        }

        return [];
    }
}
