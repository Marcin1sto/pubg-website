<?php

namespace App\Console\Commands;

use App\Services\PlayerService;
use Illuminate\Console\Command;

class CreatePlayer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pubg:create-player {nickName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user';

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
        $response = PlayerService::createPlayer($this->argument('nickName'));

        if ($response) {
            $this->info('Gracz został dodany do bazy danych');
            return 0;
        }
        $this->warn('Użytkownik już istnieje lub jest Botem!');

        return 0;
    }
}
