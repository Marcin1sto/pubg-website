<?php

namespace App\Console\Commands\System;

use Database\Factories\PlayerFactory;
use Database\Factories\PlayerMatchesFactory;
use Illuminate\Console\Command;

class FactoryData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'factory-data';

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
        if (env('APP_ENV') === 'local') {
            PlayerFactory::new()->count(10)->create();
            PlayerMatchesFactory::new()->count(1000)->create();
        }

        return 0;
    }
}
