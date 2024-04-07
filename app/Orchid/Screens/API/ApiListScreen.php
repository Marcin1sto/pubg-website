<?php

namespace App\Orchid\Screens\API;

use App\Enums\MatchGameModeEnum;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Screen;
use Orchid\Screen\Sight;
use Orchid\Support\Facades\Layout;

class ApiListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'ApiListScreen';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        $playerUpdate = '{"correct":true,"stats":{"tpp":{"type":"tpp","season_id":37,"rang_id":4,"matches":59,"wins":9,"points":302,"percent_wins":15,"percent_headshot":29,"kda":2.92,"kd":2.08,"medium_damage":258,"updated_at":"2024-02-18T22:03:33.000000Z","is_mostType":true},"fpp":{"correct":false,"msg":"Musisz rozegra\u0107 min. 25 meczy, rozegra\u0142e\u015b do tej pory: 0 meczy w trybie fpp."},"ranked":{"correct":false,"msg":"Musisz rozegra\u0107 min. 25 meczy, rozegra\u0142e\u015b do tej pory: 2 meczy w trybie ranked."}}}';
        $playerStats = '{"correct":true,"stats":{"updated_at":"2024-02-18T22:03:33.000000Z","season_id":37,"rang_id":4,"points":302,"wins":9,"percent_wins":15,"matches":59,"kd":2.08,"kda":2.92,"percent_headshot":29,"medium_damage":258,"type":"tpp"},"msg":null}';
        $playerVerification = '{"correct":true,"data":{"updated_at":"2024-02-25T17:01:09.000000Z","playerId":"account.622b9f4ff2c84987b39bebdfed5aa6e4","playerName":"Marcin1sto","clanId":"clan.8fa7fb703eb84f86bf52e649febaf700"},"msg":"Zosta\u0142e\u015b poprawnie zweryfikowany."}';

        // Ranking
        $rankingIndex = '{"correct":true,"ranking":[{"updated_at":"2024-02-17T00:14:39.000000Z","season_id":37,"rang_id":9,"points":1154,"wins":34,"percent_wins":40,"matches":85,"kd":12.98,"kda":14.33,"percent_headshot":27,"medium_damage":874,"type":"tpp","player":{"updated_at":"2024-02-17T00:14:39.000000Z","playerId":"account.769e68d0329844989dc431fec84fca77","playerName":"Lemon4ik888","clanId":null}}]}';
        $rankingRanksIndex = '[{"id":1,"created_at":"2022-10-14T19:53:35.000000Z","updated_at":"2022-10-14T19:53:35.000000Z","deleted_at":null,"name":"bronze","from":0,"to":100}]';

        return [
            ...$this->createEndpointLayout(
                'Player Update',
                'Update player data',
                env('APP_URL').'/api/bot/ranking/update/{nickName}',
                ['nickName' => 'string'],
                $playerUpdate
            ),
            ...$this->createEndpointLayout('Player data',
                'Get player data',
                env('APP_URL').'/api/bot/player/{nickname}',
                ['nickname' => 'string'],
                '{"correct":true,"data":{"updated_at":"2024-04-07T07:30:57.000000Z","playerId":"account.622b9f4ff2c84987b39bebdfed5aa6e4","playerName":"Marcin1sto","clanId":"clan.8fa7fb703eb84f86bf52e649febaf700"},"msg":""}'
            ),
            ...$this->createEndpointLayout('Player stats by mode',
                'Get player stats for specific mode',
                env('APP_URL').'/api/bot/ranking/stats/{matchMode}/{nickName}',
                ['matchMode' => 'enum: '.MatchGameModeEnum::parentModesToString()],
                $playerStats
            ),
            ...$this->createEndpointLayout('Player stats',
                'Get player all stats',
                env('APP_URL').'/api/bot/ranking/stats/{nickName}',
                [],
                '{"correct":true,"stats":{"tpp":{"updated_at":"2024-04-07T07:30:57.000000Z","season_id":37,"rang_id":4,"points":313,"wins":50,"percent_wins":16,"matches":311,"kd":2.02,"kda":3.23,"percent_headshot":22,"medium_damage":246,"type":"tpp"}},"msg":null}'
            ),
            ...$this->createEndpointLayout('Player Verification',
                'Verify player',
                env('APP_URL').'/bot/player/verification/{nickname}',
                ['nickname' => 'string'],
                $playerVerification
            ),

            //Ranking
            ...$this->createEndpointLayout('Discord Ranking by Mode etc.',
                'Get ranking by mode etc.',
                env('APP_URL').'/bot/ranking/index/{matchMode}/{component}/{count}',
                [
                    'matchMode' => 'enum: '.MatchGameModeEnum::parentModesToString(),
                    'component' => 'string enum: medium_damage,kda,points,percent_wins',
                    'count' => 'integer'
                ],
                $rankingIndex
            ),
            ...$this->createEndpointLayout('Discord Ranks.',
                'Get ranks by points.',
                env('APP_URL').'/bot/ranking/ranks',
                [],
                $rankingRanksIndex
            ),

            // Klan
            ...$this->createEndpointLayout('Get clan data from API PUBG',
                '',
                env('APP_URL').'/api/bot/clan/{clan_id}',
                [
                    'clan_id' => 'string'
                ],
                '{"correct":true,"data":{"id":"clan.8fa7fb703eb84f86bf52e649febaf700","clanName":"Discord_Polska","clanTag":"PLNY","clanLevel":18,"clanMemberCount":95}}'
            ),
        ];
    }

    private function createEndpointLayout(
        string $title,
        string $description,
        string $endpoint,
        array $request,
        string $response,
        string $method = 'GET'
    ): array
    {
        $requestSight = [];
        if (!empty($request)) {
            $requestSight[] = Sight::make('', )->render(fn() => '<b>Request</b>');
            foreach ($request as $key => $value) {
                $requestSight[] =  Sight::make($key)->render(fn() => $value);
            }
        }

        return [
            Layout::block([
                Layout::legend('user', [
                    Sight::make('endpoint')->render(fn() => $endpoint),
                    Sight::make('method')->render(fn() => $method),
                    ...$requestSight,
                    Sight::make('', )->render(fn() => '<b>Response</b>'),
                    Sight::make('json')
                        ->render(fn() => '<pre>'.json_encode(json_decode($response), JSON_PRETTY_PRINT).'</pre>'),
                ]),
            ])
                ->title($title)
                ->description($description),
        ];
    }
}
