<?php

namespace App\Orchid\Screens\Players;

use App\Models\Player;
use App\Orchid\Filters\Players\PlayerNameFilter;
use App\Orchid\Filters\Players\PlayersPubgIdFilter;
use App\Orchid\Layouts\Players\PlayersFiltersLayout;
use App\Orchid\Layouts\Players\PlayersListTable;
use Orchid\Screen\Screen;

class PlayersListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'players' => Player::
                filters([PlayerNameFilter::class, PlayersPubgIdFilter::class])
                ->paginate(10)
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Lista graczy';
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
        return [
            PlayersFiltersLayout::class,
            PlayersListTable::class
        ];
    }
}
