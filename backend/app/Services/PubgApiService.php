<?php

namespace App\Services;

use App\Enums\GamesEnum;
use App\Enums\PlatformEnum;
use App\Models\Game;
use App\Models\Season;
use stdClass;

class PubgApiService
{
    private PubgConnector $connector;

    public function __construct(PubgConnector $connector)
    {
        $this->connector = $connector;
    }

    /**
     * Pobiera informacje o graczu
     * @param string $nickname
     * @return array
     */
    public function getPlayer(string $nickname): array
    {
        $this->connector->connect("players?filter[playerNames]={$nickname}");

        if ($this->connector->connectFalse()) {
            return [
                'status' => 'error',
                'message' => 'Nie udało się pobrać danych gracza'
            ];
        }

        return [
            'status' => 'success',
            'data' => $this->connector->getData()
        ];
    }

    /**
     * Pobiera statystyki sezonowe gracza
     * @param string $playerId
     * @param string $seasonId
     * @return array
     */
    public function getPlayerSeasonStats(string $playerId, string $seasonId): array
    {
        $this->connector->connect("players/{$playerId}/seasons/{$seasonId}");

        if ($this->connector->connectFalse()) {
            return [
                'status' => 'error',
                'message' => 'Nie udało się pobrać statystyk sezonowych'
            ];
        }

        return [
            'status' => 'success',
            'data' => $this->connector->getData()
        ];
    }

    /**
     * Pobiera statystyki lifetime gracza
     * @param string $playerId
     * @return array
     */
    public function getPlayerLifetimeStats(string $playerId): array
    {
        $this->connector->connect("players/{$playerId}/seasons/lifetime");

        if ($this->connector->connectFalse()) {
            return [
                'status' => 'error',
                'message' => 'Nie udało się pobrać statystyk lifetime'
            ];
        }

        return [
            'status' => 'success',
            'data' => $this->connector->getData()
        ];
    }

    /**
     * Pobiera informacje o klanie
     * @param string $clanId
     * @return array
     */
    public function getClan(string $clanId): array
    {
        $this->connector->connect("clans/{$clanId}");

        if ($this->connector->connectFalse()) {
            return [
                'status' => 'error',
                'message' => 'Nie udało się pobrać danych klanu'
            ];
        }

        return [
            'status' => 'success',
            'data' => $this->connector->getData()
        ];
    }

    /**
     * Pobiera listę klanów
     * @param string $name
     * @return array
     */
    public function getClans(string $name): array
    {
        $this->connector->connect("clans?filter[clanNames]={$name}");

        if ($this->connector->connectFalse()) {
            return [
                'status' => 'error',
                'message' => 'Nie udało się pobrać listy klanów'
            ];
        }

        return [
            'status' => 'success',
            'data' => $this->connector->getData()
        ];
    }

    /**
     * Pobiera informacje o meczu
     * @param string $matchId
     * @return array
     */
    public function getMatch(string $matchId): array
    {
        $this->connector->connect("matches/{$matchId}");

        if ($this->connector->connectFalse()) {
            return [
                'status' => 'error',
                'message' => 'Nie udało się pobrać danych meczu'
            ];
        }

        return [
            'status' => 'success',
            'data' => $this->connector->getData()
        ];
    }

    /**
     * Pobiera listę sezonów
     * @return array
     */
    public function getSeasons(): array
    {
        $data = $this->connector->connect('seasons')->getData();

        if ($this->connector->connectFalse()) {
            return [
                'status' => 'error',
                'message' => 'Nie udało się pobrać sezonów'
            ];
        }

        foreach ($data->data as $seasonApi) {
            $explodedId = explode('.', $seasonApi->id);
            $explodedSector = explode('-', $explodedId[3]);

            if (!Season::where('api_id', $seasonApi->id)->first()) {
                $seasonNumber = $explodedSector[array_key_last($explodedSector)];

                if ($seasonApi->attributes->isCurrentSeason) {
                    $actualSeason = Season::where('isCurrentSeason', true)->first();

                    if ($actualSeason && $actualSeason->number != $seasonNumber) {
                        $actualSeason->isCurrentSeason = false;
                        $actualSeason->save();
                    }
                }

                $game = Game::where('slug', GamesEnum::PUBG->value)->first();

                // sprawdzamy czy $seasonNumber jest liczbą
                if (!is_numeric($seasonNumber)) {
                    $seasonNumber = (int) filter_var($seasonNumber, FILTER_SANITIZE_NUMBER_INT);
                }

                $season = new Season();
                $season->number = $seasonNumber;
                $season->api_id = $seasonApi->id;
                $season->game_id = $game->id;
                $season->name = 'Sezon '. $seasonNumber;
                $season->platform = $explodedSector[0];
                $season->type = $seasonApi->type;
                $season->isCurrentSeason = $seasonApi->attributes->isCurrentSeason;
                $season->isOffseason = $seasonApi->attributes->isOffseason;
                $season->save();
            }
        }

        return [
            'success' => true,
            'data' => $data
        ];
    }

    /**
     * Pobiera rankingi
     * @param string $seasonId
     * @param string $gameMode
     * @return array
     */
    public function getLeaderboards(string $seasonId, string $gameMode): array
    {
        $this->connector->connect("leaderboards/seasons/{$seasonId}/gameMode/{$gameMode}");

        if ($this->connector->connectFalse()) {
            return [
                'status' => 'error',
                'message' => 'Nie udało się pobrać rankingów'
            ];
        }

        return [
            'status' => 'success',
            'data' => $this->connector->getData()
        ];
    }

    /**
     * Pobiera telemetrię meczu
     * @param string $matchId
     * @return array
     */
    public function getMatchTelemetry(string $matchId): array
    {
        $this->connector->connect("matches/{$matchId}/telemetry");

        if ($this->connector->connectFalse()) {
            return [
                'status' => 'error',
                'message' => 'Nie udało się pobrać telemetrii meczu'
            ];
        }

        return [
            'status' => 'success',
            'data' => $this->connector->getData()
        ];
    }

    /**
     * Pobiera status API
     * @return array
     */
    public function getStatus(): array
    {
        $this->connector->connect("status");

        if ($this->connector->connectFalse()) {
            return [
                'status' => 'error',
                'message' => 'Nie udało się pobrać statusu API'
            ];
        }

        return [
            'status' => 'success',
            'data' => $this->connector->getData()
        ];
    }
}
