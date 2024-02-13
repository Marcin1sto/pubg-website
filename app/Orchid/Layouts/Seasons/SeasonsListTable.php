<?php

namespace App\Orchid\Layouts\Seasons;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class SeasonsListTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'seasons';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
//        dd($this->query);
        return [
            TD::make('id', 'ID')->sort(),
            TD::make('name', 'Name')->sort(),
            TD::make('isCurrentSeason', 'Is Current Season')
                ->render(function ($season) {
                    return $season->isCurrentSeason ? 'Tak' : '';
                })
                ->sort(),
            TD::make('api_id', 'API ID')->sort(),
        ];
    }
}
