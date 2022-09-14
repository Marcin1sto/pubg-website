<?php

namespace App\Services;

use App\Models\Player;
use App\Models\PlayerMatchStatistic;
use App\Models\Season;

class PlayerMatchSeasonStatisticService
{
    /**
     * @param Player $player
     * @param string|null $seasonNumber
     * @return array
     */
    public static function downloadAllPlayerSeasonStatistic(Player $player, ?string $seasonNumber, bool $saveMatches = false): array
    {
        if ($player->canUpdateMatches()) {
            $season = Season::where('number', $seasonNumber)->first();

            if (!$season) {
                $season = Season::where('isCurrentSeason', true)->first();
            }

            $playerId = $player->playerId;

            $connector = new PubgConnector();
            $last7daysMatches = $connector->connect('players?filter[playerIds]='.$player->playerId)->getData()
                ->data[0]->relationships->matches->data;

            $allMatchesPlayer = [];
            foreach ($last7daysMatches as $match) {
                $matchDb = PlayerMatchStatistic::where('match_id', $match->id)->first();

                if (!$matchDb) {
                    $matchConnector = new PubgConnector();
                    $matchResponse = $matchConnector->connect('matches/'.$match->id)->getData();

                    if ($matchResponse->data->attributes->matchType == 'official') {
                        $players = array_filter($matchResponse->included, function ($value) {
                            return $value->type === 'participant';
                        });

                        $playerMatches = array_filter($players, function ($value, $key) use ($playerId) {
                            $matchPlayerId = $value->attributes->stats->playerId;

                            return $matchPlayerId &&
                                $value->type == 'participant' &&
                                $matchPlayerId == $playerId;
                        }, ARRAY_FILTER_USE_BOTH);


                        $allMatchesPlayer[] = collect($playerMatches)->first();
                    }
                }
            }


            foreach ($allMatchesPlayer as $match) {
                $match->attributes->stats->season_id = $season->id;
            }

            if ($saveMatches) {
                foreach ($allMatchesPlayer as $match) {
                    $matchDB = PlayerMatchStatistic::where('match_id', $match->id)->where('player_id', $player->id)->first();
                    $statistics = $match->attributes->stats;

                    if (!$matchDB) {
                        $newMatch = new PlayerMatchStatistic();
                        $newMatch->fill(collect($statistics)->except('playerId')->toArray());
                        $newMatch->match_id = $match->id;
                        $newMatch->player_id = $player->id;
                        $newMatch->save();
                    }
                }
            }

            $player->update([
                'matchesUpdate' => date('Y-m-d H:i:s')
            ]);

            return $allMatchesPlayer;
        }

        return [];
    }
}
