<?php
namespace App\Services;


use App\Models\Player;
use App\Models\Season;

class SeasonService
{
    const PREFIX = 'seasons';

    /**
     * Download Seasons for pc from PUBG API
     * @return void
     */
    public static function downloadSeasons(): void
    {
        $pubgConnector = new PubgConnector();
        $data = $pubgConnector->connect(self::PREFIX)->getData();

        if (!$data && env('APP_ENV') === 'local') {
            $season = new Season();
            $season->number = 0;
            $season->api_id = '';
            $season->name = 'Sezon '. 0;
            $season->type = 'pc';
            $season->isCurrentSeason = true;
            $season->isOffseason = false;
            $season->save();
        } else {
            foreach ($data->data as $seasonApi) {
                $explodedId = explode('.', $seasonApi->id);
                $explodedSector = explode('-', $explodedId[3]);
                if ($explodedSector[0] == 'pc' && !Season::where('api_id', $seasonApi->id)->first()) {
                    $seasonNumber = $explodedSector[array_key_last($explodedSector)];

                    if ($seasonApi->attributes->isCurrentSeason) {
                        $actualSeason = Season::where('isCurrentSeason', true)->first();

                        if ($actualSeason && $actualSeason->number != $seasonNumber) {
                            $actualSeason->isCurrentSeason = false;
                            $actualSeason->save();
                        }
                    }

                    $season = new Season();
                    $season->number = $seasonNumber;
                    $season->api_id = $seasonApi->id;
                    $season->name = 'Sezon '. $seasonNumber;
                    $season->type = $seasonApi->type;
                    $season->isCurrentSeason = $seasonApi->attributes->isCurrentSeason;
                    $season->isOffseason = $seasonApi->attributes->isOffseason;
                    $season->save();
                }
            }
        }
    }
}
