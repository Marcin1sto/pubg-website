<?php

namespace App\Jobs;

use App\Services\PlayerService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\RateLimited;
use Illuminate\Queue\SerializesModels;

class ProcessPlayer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $nickName;

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
     */
    public function handle()
    {
        try {
            PlayerService::createPlayer($this->nickName);
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
