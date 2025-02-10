<?php
declare(strict_types=1);

namespace App\Orchid\Screens\Stream;

use App\Models\Season;
use App\Models\Streamer;
use App\Orchid\Layouts\Seasons\SeasonsListTable;
use App\Orchid\Layouts\Streamers\StreamersListTable;
use App\Services\SeasonService;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class StreamListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'streamers' => Streamer::all()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Lista stremerów';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Dodaj'))
                ->icon('bs.plus-circle')
                ->route('streamers.index.add'),
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
            StreamersListTable::class,
        ];
    }
}
