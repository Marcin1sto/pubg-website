<?php

namespace App\Console\Commands;

use App\Models\Season;
use App\Services\SeasonService;
use Illuminate\Console\Command;

class DownloadSeasons extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'download-seasons';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download Seasons from PUBG API';

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
        (new \App\Services\SeasonService)->downloadSeasons();

        $this->info('Zaktualizowano dane o sezonach we wszystkich grach.');

        return 'true';
    }
}
