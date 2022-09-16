<?php

namespace App\Jobs;

use App\Services\PlayerService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Redis\LimiterTimeoutException;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\RateLimited;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;

class ProcessPlayer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $nickName;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public int $tries = 25;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $playerName)
    {
        $this->nickName = $playerName;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws LimiterTimeoutException
     */
    public function handle()
    {
        Redis::throttle('default')->block(0)->allow(1)->every(10)->then(function () {
            info('Lock obtained...');

            PlayerService::createPlayer($this->nickName);
        }, function () {
            // Could not obtain lock...
            return $this->release(120);
        });
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
