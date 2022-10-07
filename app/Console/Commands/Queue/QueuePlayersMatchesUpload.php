<?php

namespace App\Console\Commands\Queue;

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
    protected $signature = 'queue:matches';

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

        foreach ($players as $key => $player) {
            switch ($key) {
                case $key >= 20:
                    $timeDelay = (int)($key * 30 / 2);
                case $key >= 40:
                    $timeDelay = (int)($key * 30 / 4);
                default: $timeDelay = (int)($key * 30 /  2);
            }

            PlayerMatchesProcess::dispatch($player, $seasonNumber, true)->delay(now()->addSeconds($timeDelay))->onQueue('default');
        }

        $this->info('Do kolejki zostały dodane mecze do pobrania.');

        return 0;
    }
}
