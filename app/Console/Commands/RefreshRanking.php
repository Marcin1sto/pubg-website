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
    public function handle(): int
    {
        $players = Player::with('actualMatches')->get()->filter(function ($object) {
            return $object->actualMatches->count() >= 25;
        });
        $this->output->progressStart(count($players));
        $playersFails = [];

        foreach ($players as $key => $player) {
            $status = RankingService::calculatePlayerPoints($player->playerName);
            if (is_null($status)) {
                $playersFails[$key] = $player->playerName;
            } else {
                $this->output->progressAdvance();
            }
        }
        $this->output->progressFinish();

        foreach ($playersFails as $playerName) {
            $this->error('Wystąpił problem z obliczeniem rankingu gracza: '. $playerName);
        }

        $this->info('Zakończono obliczanie rankingu.');
        return 0;
    }
}
