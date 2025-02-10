<?php

namespace App\Orchid\Layouts\Ranking;

use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class BoostRankingStatsEditLayout extends Rows
{
    public $target = 'boosts';

    protected function fields(): iterable
    {
        $inputs = [];

        if (!empty($this->query->get('boosts'))) {
            foreach ($this->query->get('boosts') as $boost) {
                $inputs[] = Input::make('boosts.' . $boost->stat_type)
                    ->type('float')
                    ->value(floatval($boost->count))
                    ->max(10)
                    ->required()
                    ->title(ucfirst($boost->stat_type))
                    ->placeholder(ucfirst($boost->stat_type));
            }
        }

        return $inputs;
    }
}
