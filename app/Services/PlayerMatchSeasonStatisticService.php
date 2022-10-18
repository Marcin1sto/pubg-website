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
    public static function downloadAllPlayerMatches(Player $player, ?string $seasonNumber = null, bool $saveMatches = false): array|Collection
    {
        if ($player->canUpdateMatches()) {
            if ($seasonNumber) {
                $actualSeason = Season::where('number', $seasonNumber)->first();
            }

            if (!isset($actualSeason)) {
                $actualSeason = Season::where('isCurrentSeason', true)->first();
            }

            $beforeSeason = Season::where('number', $actualSeason->number - 1)->first();

            $playerId = $player->playerId;

            $connector = new PubgConnector();
            $last7daysMatches = $connector->connect('players?filter[playerIds]='.$player->playerId);

            if (!$connector->connectFalse()) {
                $last7daysMatches = $last7daysMatches->getData()
                    ->data[0]->relationships->matches->data;

                $allMatchesPlayer = [];
                foreach ($last7daysMatches as $key => $match) {
                    $matchDb = PlayerMatchStatistic::where('match_id', $match->id)->where('player_id', $player->id)->first();

                    if (!$matchDb) {
                        $matchConnector = new PubgConnector();
                        $matchResponse = $matchConnector->connect('matches/'.$match->id);

                        if (!$matchResponse->connectFalse()) {
                            $matchResponse = $matchResponse->getData();
                            if ($matchResponse->data->attributes->matchType == 'official' ||
                                $matchResponse->data->attributes->matchType == 'custom') {
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

                                $playerMatch['attributes']['stats']['gameMode'] = $matchResponse->data->attributes->gameMode;
                                $playerMatch['attributes']['stats']['type'] = $matchResponse->data->attributes->matchType;
                                $playerMatch['attributes']['stats']['mapName'] = $matchResponse->data->attributes->mapName;
                                $playerMatch['attributes']['stats']['isCustomMatch'] = $matchResponse->data->attributes->isCustomMatch;
                                $playerMatch['attributes']['stats']['season_id'] = $seasonId;
                                $allMatchesPlayer[$key] = (array)$playerMatch;
                            }
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
                            $newMatch->match_id = $match['id'];
                            $newMatch->type = $match['attributes']['stats']['gameMode'];
                            $newMatch->player_id = $player->id;
                            $newMatch->save();
                        }
                    }

                    $player->update([
                        'matchesUpdate' => date('Y-m-d H:i:s')
                    ]);

                    return PlayerMatchStatistic::where('player_id', $player->id)->get();
                }

                $player->update([
                    'matchesUpdate' => date('Y-m-d H:i:s')
                ]);
            }

            return $allMatchesPlayer;
        }

        return [];
    }
}
