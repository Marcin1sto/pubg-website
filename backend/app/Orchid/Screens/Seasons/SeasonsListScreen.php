<?php
declare(strict_types=1);

namespace App\Orchid\Screens\Seasons;

use App\Models\Season;
use App\Orchid\Layouts\Seasons\SeasonsListTable;
use App\Services\SeasonService;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;

class SeasonsListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'seasons' => Season::orderBy('number', 'desc')->paginate(10)
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Lista sezonów';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Wczytaj sezony z API'))
                ->icon('bs.plus-circle')
                ->method('loadSeasons')
        ];
    }

    public function loadSeasons(): void
    {
        (new SeasonService)->downloadSeasons();
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            SeasonsListTable::class
        ];
    }
}
