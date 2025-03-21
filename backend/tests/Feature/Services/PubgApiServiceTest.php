<?php

namespace Tests\Feature\Services;

use App\Services\PubgApiService;
use App\Services\PubgConnector;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PubgApiServiceTest extends TestCase
{
    use RefreshDatabase;

    private PubgApiService $service;
    private PubgConnector $connector;

    protected function setUp(): void
    {
        parent::setUp();
        $this->connector = new PubgConnector();
        $this->service = new PubgApiService($this->connector);
    }

    public function testGetPlayer()
    {
        $result = $this->service->getPlayer('testPlayer');
        
        $this->assertIsArray($result);
        $this->assertArrayHasKey('status', $result);
        $this->assertArrayHasKey('data', $result);
    }

    public function testGetPlayerSeasonStats()
    {
        $result = $this->service->getPlayerSeasonStats('testPlayerId', '2023');
        
        $this->assertIsArray($result);
        $this->assertArrayHasKey('status', $result);
        $this->assertArrayHasKey('data', $result);
    }

    public function testGetClan()
    {
        $result = $this->service->getClan('testClanId');
        
        $this->assertIsArray($result);
        $this->assertArrayHasKey('status', $result);
        $this->assertArrayHasKey('data', $result);
    }

    public function testGetMatch()
    {
        $result = $this->service->getMatch('testMatchId');
        
        $this->assertIsArray($result);
        $this->assertArrayHasKey('status', $result);
        $this->assertArrayHasKey('data', $result);
    }

    public function testGetSeasons()
    {
        $result = $this->service->getSeasons();
        
        $this->assertIsArray($result);
        $this->assertArrayHasKey('status', $result);
        $this->assertArrayHasKey('data', $result);
    }

    public function testGetLeaderboards()
    {
        $result = $this->service->getLeaderboards('2023', 'solo');
        
        $this->assertIsArray($result);
        $this->assertArrayHasKey('status', $result);
        $this->assertArrayHasKey('data', $result);
    }

    public function testGetMatchTelemetry()
    {
        $result = $this->service->getMatchTelemetry('testMatchId');
        
        $this->assertIsArray($result);
        $this->assertArrayHasKey('status', $result);
        $this->assertArrayHasKey('data', $result);
    }

    public function testGetStatus()
    {
        $result = $this->service->getStatus();
        
        $this->assertIsArray($result);
        $this->assertArrayHasKey('status', $result);
        $this->assertArrayHasKey('data', $result);
    }
} 