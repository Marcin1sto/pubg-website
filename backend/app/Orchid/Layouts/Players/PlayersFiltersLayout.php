<?php

namespace App\Orchid\Layouts\Players;

use App\Orchid\Filters\Players\PlayerNameFilter;
use App\Orchid\Filters\Players\PlayersPubgIdFilter;
use Orchid\Filters\Filter;
use Orchid\Screen\Layouts\Selection;

class PlayersFiltersLayout extends Selection
{
    /**
     * @return string[]|Filter[]
     */
    public function filters(): array
    {
        return [
            PlayerNameFilter::class,
            PlayersPubgIdFilter::class
        ];
    }
}
