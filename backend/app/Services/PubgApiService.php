<?php

namespace App\Services;

use App\Enums\PlatformEnum;
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
        $this->connector->connect("seasons");
        
        if ($this->connector->connectFalse()) {
            return [
                'status' => 'error',
                'message' => 'Nie udało się pobrać listy sezonów'
            ];
        }

        return [
            'status' => 'success',
            'data' => $this->connector->getData()
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