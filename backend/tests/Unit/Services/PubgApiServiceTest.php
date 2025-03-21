<?php

namespace Tests\Unit\Services;

use App\Services\PubgApiService;
use App\Services\PubgConnector;
use PHPUnit\Framework\TestCase;
use Mockery;

class PubgApiServiceTest extends TestCase
{
    private PubgApiService $service;
    private PubgConnector $connector;

    protected function setUp(): void
    {
        parent::setUp();
        $this->connector = Mockery::mock(PubgConnector::class);
        $this->service = new PubgApiService($this->connector);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function testGetPlayerSuccess()
    {
        $expectedData = ['id' => '123', 'name' => 'testPlayer'];
        
        $this->connector->shouldReceive('connect')
            ->with('players?filter[playerNames]=testPlayer')
            ->once();
        
        $this->connector->shouldReceive('connectFalse')
            ->andReturn(false);
        
        $this->connector->shouldReceive('getData')
            ->andReturn($expectedData);

        $result = $this->service->getPlayer('testPlayer');

        $this->assertEquals('success', $result['status']);
        $this->assertEquals($expectedData, $result['data']);
    }

    public function testGetPlayerError()
    {
        $this->connector->shouldReceive('connect')
            ->with('players?filter[playerNames]=testPlayer')
            ->once();
        
        $this->connector->shouldReceive('connectFalse')
            ->andReturn(true);

        $result = $this->service->getPlayer('testPlayer');

        $this->assertEquals('error', $result['status']);
        $this->assertEquals('Nie udało się pobrać danych gracza', $result['message']);
    }

    public function testGetPlayerSeasonStatsSuccess()
    {
        $expectedData = ['season' => '2023', 'stats' => ['kills' => 100]];
        
        $this->connector->shouldReceive('connect')
            ->with('players/123/seasons/2023')
            ->once();
        
        $this->connector->shouldReceive('connectFalse')
            ->andReturn(false);
        
        $this->connector->shouldReceive('getData')
            ->andReturn($expectedData);

        $result = $this->service->getPlayerSeasonStats('123', '2023');

        $this->assertEquals('success', $result['status']);
        $this->assertEquals($expectedData, $result['data']);
    }

    public function testGetClanSuccess()
    {
        $expectedData = ['id' => '456', 'name' => 'testClan'];
        
        $this->connector->shouldReceive('connect')
            ->with('clans/456')
            ->once();
        
        $this->connector->shouldReceive('connectFalse')
            ->andReturn(false);
        
        $this->connector->shouldReceive('getData')
            ->andReturn($expectedData);

        $result = $this->service->getClan('456');

        $this->assertEquals('success', $result['status']);
        $this->assertEquals($expectedData, $result['data']);
    }

    public function testGetMatchSuccess()
    {
        $expectedData = ['id' => '789', 'type' => 'match'];
        
        $this->connector->shouldReceive('connect')
            ->with('matches/789')
            ->once();
        
        $this->connector->shouldReceive('connectFalse')
            ->andReturn(false);
        
        $this->connector->shouldReceive('getData')
            ->andReturn($expectedData);

        $result = $this->service->getMatch('789');

        $this->assertEquals('success', $result['status']);
        $this->assertEquals($expectedData, $result['data']);
    }

    public function testGetSeasonsSuccess()
    {
        $expectedData = ['seasons' => ['2023-1', '2023-2']];
        
        $this->connector->shouldReceive('connect')
            ->with('seasons')
            ->once();
        
        $this->connector->shouldReceive('connectFalse')
            ->andReturn(false);
        
        $this->connector->shouldReceive('getData')
            ->andReturn($expectedData);

        $result = $this->service->getSeasons();

        $this->assertEquals('success', $result['status']);
        $this->assertEquals($expectedData, $result['data']);
    }

    public function testGetLeaderboardsSuccess()
    {
        $expectedData = ['season' => '2023', 'gameMode' => 'solo'];
        
        $this->connector->shouldReceive('connect')
            ->with('leaderboards/seasons/2023/gameMode/solo')
            ->once();
        
        $this->connector->shouldReceive('connectFalse')
            ->andReturn(false);
        
        $this->connector->shouldReceive('getData')
            ->andReturn($expectedData);

        $result = $this->service->getLeaderboards('2023', 'solo');

        $this->assertEquals('success', $result['status']);
        $this->assertEquals($expectedData, $result['data']);
    }

    public function testGetMatchTelemetrySuccess()
    {
        $expectedData = ['matchId' => '789', 'telemetry' => ['events' => []]];
        
        $this->connector->shouldReceive('connect')
            ->with('matches/789/telemetry')
            ->once();
        
        $this->connector->shouldReceive('connectFalse')
            ->andReturn(false);
        
        $this->connector->shouldReceive('getData')
            ->andReturn($expectedData);

        $result = $this->service->getMatchTelemetry('789');

        $this->assertEquals('success', $result['status']);
        $this->assertEquals($expectedData, $result['data']);
    }

    public function testGetStatusSuccess()
    {
        $expectedData = ['status' => 'ok'];
        
        $this->connector->shouldReceive('connect')
            ->with('status')
            ->once();
        
        $this->connector->shouldReceive('connectFalse')
            ->andReturn(false);
        
        $this->connector->shouldReceive('getData')
            ->andReturn($expectedData);

        $result = $this->service->getStatus();

        $this->assertEquals('success', $result['status']);
        $this->assertEquals($expectedData, $result['data']);
    }
} 