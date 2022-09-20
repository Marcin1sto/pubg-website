<?php

namespace App\Console\Commands;

use App\Jobs\ProcessPlayer;
use Illuminate\Console\Command;

class PlayersFromJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pubg:players-json';

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

        foreach ($json->players as $player) {
            if (isset($player->name)) {
                ProcessPlayer::dispatch($player->name)->delay(now()->addSeconds(10))->onQueue('default');
            }
        }


        return 0;
    }
}
