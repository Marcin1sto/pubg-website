<?php

namespace App\Orchid\Layouts\Streamers;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class StreamersListTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'streamers';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('link', 'Link')->sort(),
            TD::make('discord_id', 'Discord ID')->sort(),
        ];
    }
}
