<?php

namespace App\Jobs;

use App\Models\Player;
use App\Services\PlayerMatchSeasonStatisticService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\RateLimited;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;

class PlayerMatchesProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private Player $player, private int $seasonNumber, private bool $withSave)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            PlayerMatchSeasonStatisticService::downloadAllPlayerMatches($this->player, $this->seasonNumber, $this->withSave);
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
    }

    /**
     * Get the middleware the job should pass through.
     *
     * @return array
     */
    public function middleware(): array
    {
        return [new RateLimited('default')];
    }
}
