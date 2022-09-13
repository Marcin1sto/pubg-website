<?php

namespace App\Console\Commands;

use App\Models\Player;
use App\Services\RankingService;
use Illuminate\Console\Command;

class RefreshRanking extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pubg:refresh-ranking';

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

        foreach ($players as $player) {
            RankingService::calculatePlayerPoints($player->playerName);
        }

        return 0;
    }
}
