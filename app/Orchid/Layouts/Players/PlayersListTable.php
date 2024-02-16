<?php

namespace App\Orchid\Layouts\Players;

use App\Models\Player;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class PlayersListTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'players';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
//            TD::make('id', 'ID')->sort(),
            TD::make('playerName', 'NickName')->sort(),
            TD::make('playerId', 'Player PUBG ID')->sort(),
            TD::make('created_at', 'Utworzono')
                ->render(function (Player $player) {
                    return $player->updated_at->diffForHumans();
                })
                ->sort(),
            TD::make('updated_at', 'Zaktualizowano')
                ->render(function (Player $player) {
                    return $player->updated_at->diffForHumans();
                })
                ->sort(),
            TD::make('matchesUpdate', 'Zaktualizowano mecze')
                ->render(function (Player $player) {
                    return $player->updated_at->diffForHumans();
                })
                ->sort(),
        ];
    }
}
