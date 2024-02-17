<?php

namespace App\Orchid\Layouts\Players;

use App\Models\Player;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
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
            TD::make('playerName', 'NickName')->sort(),
            TD::make('playerId', 'Player PUBG ID')->sort(),
            TD::make('clanId', 'PUBG Clan ID')->sort(),
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
            TD::make('Akcje')
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Player $player) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([
                        Button::make(__('Aktualizuj mecze'))
                            ->icon('bs.update')
                            ->method('updateMatches', [
                                'player' => $player->id,
                            ]),
                        Button::make(__('Aktualizuj nickname'))
                            ->icon('bs.update')
                            ->method('updateNickName', [
                                'player' => $player->id,
                            ]),
                        Button::make(__('Aktualizuj klan'))
                            ->icon('bs.update')
                            ->method('updateClanID', [
                                'player' => $player->id,
                            ]),
                        Button::make(__('Usuń'))
                            ->icon('bs.remove')
                            ->confirm(__('Czy napewno chcesz usunąć gracza '. $player->playerName . ' z bazy danych?'))
                            ->method('remove', [
                                'player' => $player->id,
                            ])
                    ])),
        ];
    }
}
