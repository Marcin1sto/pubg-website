<?php

namespace App\Orchid\Layouts\Ranking;

use App\Enums\MatchGameModeEnum;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class BoostValueExampleLayout extends Table
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    protected $target = 'players';

    protected function columns(): iterable
    {
        $statsExample = [];
        foreach (MatchGameModeEnum::parentModes() as $mode) {
            $statsExample[] = TD::make(ucfirst($mode))->render(function ($player) use ($mode) {
                return $player->discordRanking->where('type', $mode)->first()?->points;
            });
        }

        return [
            TD::make('nickName')->render(function ($player) {
                return "<strong>{$player->playerName}</strong>";
            }),
            ...$statsExample
        ];
    }
}
