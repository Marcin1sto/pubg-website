<?php
namespace App\Services;


use App\Enums\GamesEnum;
use App\Models\Player;
use App\Models\Season;

class SeasonService
{
    const PREFIX = 'seasons';

    public PubgApiService $pubgApiService;

    public function __construct()
    {
        $this->pubgApiService = new PubgApiService(new PubgConnector());
    }

    /**
     * Download Seasons for pc from PUBG API
     * @return void
     */
    public function downloadSeasons(): void
    {
//        $this->downloadSeasonsFromApi();

        foreach (GamesEnum::values() as $game) {
            if ($game === GamesEnum::PUBG->value) {
                $this->pubgApiService->getSeasons();
            }
        }

//        if (env('APP_ENV') === 'local') {
//            $this->importFakeSeason();
//        } else {
//            $this->downloadSeasonsFromApi();
//        }
    }

    public function importFakeSeason()
    {
        $actualSeason = Season::where('isCurrentSeason', true)->first();

        $season = new Season();
        $season->number = $actualSeason ? $actualSeason->number + 1 : 0;
        $season->api_id = '';
        $season->name = 'Sezon '. $actualSeason ? $actualSeason->number + 1 : 0;
        $season->type = 'pc';
        $season->isCurrentSeason = true;
        $season->isOffseason = false;
        $season->save();

        if ($actualSeason) {
            $actualSeason->isCurrentSeason = false;
            $actualSeason->save();
        }

    }

    public function downloadSeasonsFromApi()
    {
        // TODO: Add logic for multi games

        $pubgConnector = new PubgConnector();
        $data = $pubgConnector->connect(self::PREFIX)->getData();
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
