<?php

namespace App\Console\Commands;

use App\Services\PlayerSeasonStatisticService;
use Illuminate\Console\Command;

class GetPlayerSeasonStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pubg:player-season {nickName} {numberSeason?}';

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
        PlayerSeasonStatisticService::updatePlayerSeasonStatistic($this->argument('nickName'), $this->argument('numberSeason'));

        $this->info('Zaktualizowano dane gracza.');

        return 0;
    }
}
