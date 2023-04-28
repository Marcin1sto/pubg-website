<?php

namespace App\Console\Commands;

use App\Models\AllPubgPlayersStatistic;
use App\Models\Player;
use App\Models\PlayerMatchStatistic;
use Illuminate\Console\Command;

class RefreshWebStatistic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pubg:refresh-web-statistic';

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
        $statistic = AllPubgPlayersStatistic::all()->first();

        if (!$statistic) {
            AllPubgPlayersStatistic::create([
                'count_players' => Player::all()->count(),
                'count_matches' => PlayerMatchStatistic::all()->count(),
                'count_wins' => PlayerMatchStatistic::all()->where('winPlace', 1)->count(),
                'count_kills' => PlayerMatchStatistic::all()->sum('kills')
            ]);
        }

        $statistic->update([
            'count_players' => Player::all()->count(),
            'count_matches' => PlayerMatchStatistic::all()->count(),
            'count_wins' => PlayerMatchStatistic::all()->where('winPlace', 1)->count(),
            'count_kills' => PlayerMatchStatistic::all()->sum('kills')
        ]);

        $this->info('Zakończono ustanawianie statystyk strony.');
        return 0;
    }
}

