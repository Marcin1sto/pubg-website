<?php

namespace App\Orchid\Screens\Ranking;

use App\Enums\MatchGameModeEnum;
use App\Models\Player;
use App\Models\Ranking\BoostRankingStat;
use App\Orchid\Layouts\Ranking\BoostRankingStatsEditLayout;
use App\Orchid\Layouts\Ranking\BoostValueExampleLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;

class BoostConfigureScreen extends Screen
{

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $players = Player::select(['playerName'])
            ->with('discordRanking')
            ->has('discordRanking', '>=', 2)
            ->whereHas('discordRanking', function ($query) {
                $query->where('points', '>', 0);
            })
            ->withCount('discordRanking')
            ->take(10)
            ->orderBy('discord_ranking_count', 'desc')
//            ->join('player_stats', 'players.id', '=', 'player_stats.player_id')
            ->get();
//        dd($players);
        return [
            'modes' => MatchGameModeEnum::parentModesToString(),
            'boosts' => BoostRankingStat::all(),
            'players' => $players
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Konfiguracja boostów rankingowych';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {

        return [
            Button::make(__('Save'))
                ->icon('bs.check-circle')
                ->confirm('Czy na pewno chcesz zapisać zmiany? Spowoduje to nowe przeliczanie statystyk nawet w środku sezonu!')
                ->method('save'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::split([
                Layout::block(BoostRankingStatsEditLayout::class)->vertical(),
                Layout::block(BoostValueExampleLayout::class)->vertical(),
            ]),
        ];
    }

    public function save(Request $request)
    {
        foreach ($request->input('boosts') as $key => $boost) {
            BoostRankingStat::where('stat_type', $key)->update(['count' => $boost]);
        }
    }

    public function asyncRefresh(Request $request)
    {
        $players = Player::select('playerName')->with('discordRanking')
            ->has('discordRanking', '>=', 2)
            ->whereHas('discordRanking', function ($query) {
                $query->where('points', '>', 0);
            })
            ->withCount('discordRanking')
            ->take(10)
            ->orderBy('discord_ranking_count', 'desc')
            ->get();

        $newBoosts = $request->input('boosts');
        dd($newBoosts);
        $newBoostsResult = [];
        if (!empty($newBoosts)) {
            foreach ($players as $player) {
                $points = [];

                foreach ($newBoosts as $key => $boost) {
                    $playerModePoints = $player->discordRanking->where('type', $key)->first()?->points;

                    if ($playerModePoints) {
                        $points[$key] = [
                            'before' => $playerModePoints,
                            'after' => $playerModePoints * $boost
                        ];
                    }
                }

                $newBoostsResult[] = [
                    'nickName' => $player->playerName,
                    'points' => $points
                ];
            }
        }
        dd($this, $newBoostsResult);
        return [
            'players' => $newBoostsResult
        ];
    }
}
