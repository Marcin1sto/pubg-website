<?php

namespace App\Console\Commands\Queue;

use App\Jobs\ProcessPlayer;
use App\Services\PlayerService;
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
            PlayerService::createPlayer($player->name, 'steam');
        }

        $this->info('Gracze zostali dodani do kolejki.');

        return 0;
    }
}
