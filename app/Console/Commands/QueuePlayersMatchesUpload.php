<?php

namespace App\Console\Commands;

use App\Jobs\PlayerMatchesProcess;
use App\Models\Player;
use App\Models\Season;
use Illuminate\Console\Command;

class QueuePlayersMatchesUpload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pubg:queue-matches';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $players = Player::all();
        $seasonNumber = Season::where('isCurrentSeason', true)->first()->number;

        foreach ($players as $player) {
            PlayerMatchesProcess::dispatch($player, $seasonNumber, true);
        }

        return 0;
    }
}
