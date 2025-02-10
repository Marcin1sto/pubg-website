<?php

namespace App\Console\Commands;

use App\Models\PlayerMatchStatistic;
use App\Services\PubgConnector;
use Dflydev\DotAccessData\Data;
use Illuminate\Console\Command;

class UpdatePlayedAtValues extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:update-played-at';

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
        $groupedMatches = PlayerMatchStatistic::all()->groupBy('match_id');

        foreach ($groupedMatches as $match_id => $groupedMatch) {
            $connector = new PubgConnector();
            $connector = $connector->connect('matches/'.$match_id);

            if (!$connector->connectFalse()) {
                $response = $connector->getData()->data;

                foreach ($groupedMatch as $match)  {
                    $match->update(['played_at' => date('Y-m-d H:i:s', strtotime($response->attributes->createdAt))]);
                }
            }
        }
    }
}
