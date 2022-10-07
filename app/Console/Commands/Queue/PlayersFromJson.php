<?php

namespace App\Console\Commands\Queue;

use App\Jobs\ProcessPlayer;
use Illuminate\Console\Command;

class PlayersFromJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'queue:players-json';

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
        $json = json_decode(file_get_contents(storage_path() . "/players.json"));

        foreach ($json->players as $key => $player) {
            if (isset($player->name)) {
                switch ($key) {
                    case $key >= 20:
                        $timeDelay = (int)($key * 30 /  2);
                    case $key >= 40:
                        $timeDelay = (int)($key * 30 /  3);
                    default: $timeDelay = (int)($key * 30 /  2);
                }

                var_dump($timeDelay);
                ProcessPlayer::dispatch($player->name)->delay(now()->addSeconds($timeDelay));
            }
        }

        $this->info('Gracze zostali dodani do kolejki.');

        return 0;
    }
}
