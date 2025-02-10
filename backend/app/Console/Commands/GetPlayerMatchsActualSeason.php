<?php

namespace App\Console\Commands;

use App\Models\Player;
use App\Models\PlayerMatchStatistic;
use App\Services\PlayerMatchSeasonStatisticService;
use App\Services\PlayerService;
use App\Services\RankingService;
use Illuminate\Console\Command;

class GetPlayerMatchsActualSeason extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pubg:player-matches {nickName}';

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
    public function handle(): bool|int
    {
        $nickName = $this->argument('nickName');

        $player = Player::where('playerName', $nickName)->first();
        if (!$player) {
            $player = PlayerService::createPlayer($nickName);
        }

        if (is_null($player)) {
            $this->alert('Wystąpił problem z połaczeniem się do PUBG API');
            return false;
        }

        $matches = PlayerMatchSeasonStatisticService::downloadAllPlayerMatches(
            $player,
        );

        $count = 0;
        $this->output->progressStart(count($matches));

        foreach ($matches as $match) {
            $matchDB = PlayerMatchStatistic::where('match_id', $match['id'])->where('player_id', $player->id)->first();
            $statistics = $match['attributes']['stats'];

            if (!$matchDB) {
                $newMatch = new PlayerMatchStatistic();
                $newMatch->fill(collect($statistics)->except('playerId')->toArray());
                $newMatch->match_id = $match['id'];
                $newMatch->player_id = $player->id;
                $newMatch->save();

                $this->output->progressAdvance();
                $count++;
            }
        }

        RankingService::calculatePlayerPoints($nickName);

        $this->output->progressFinish();
        $this->info('Dodano '. $count . ' meczy gracz: '. $nickName);

        return false;
    }
}
