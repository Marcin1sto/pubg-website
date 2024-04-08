<?php

namespace App\Orchid\Screens\Stream;

use App\Models\Streamer;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Illuminate\Validation\Rule;

class StreamerEditScreen extends Screen
{

    public $streamer;

    public function query(Streamer $streamer): array
    {
        $this->streamer = $streamer;

        return [
            'streamer' => $streamer,
        ];
    }

    public function name(): string
    {
        return $this->streamer->exist ? 'Edit Streamer' : 'Create Streamer';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return '';
    }

    public function permission(): ?iterable
    {
        return [
            'platform.streamers.index.add',
        ];
    }

    public function commandBar()
    {
        return [
            Button::make(__('Save'))
                ->icon('bs.check-circle')
                ->method('save'),
        ];
    }

    public function layout(): iterable
    {
        return [

        ];
    }

    public function save(Streamer $streamer, Request $request)
    {
        $streamer->fill($request->get('streamer'))->save();
        $streamer->save();
        return redirect()->route('streamers.index');
    }
}
