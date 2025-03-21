<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Game::create([
            'name' => 'PUBG: BATTLEGROUNDS',
            'slug' => 'pubg',
            'api_key' => env('API_PUBG_TOKEN'),
            'api_url' => env('API_PUBG_URL'),
            'is_active' => true
        ]);

        Game::create([
            'name' => 'Call of Duty: Warzone',
            'slug' => 'cod-warzone',
            'api_key' => env('API_COD_WARZONE_TOKEN'),
            'api_url' => env('API_COD_WARZONE_URL'),
            'is_active' => true
        ]);

        Game::create([
            'name' => 'Fortnite',
            'slug' => 'fortnite',
            'api_key' => env('API_FORTNITE_TOKEN'),
            'api_url' => env('API_FORTNITE_URL'),
            'is_active' => true
        ]);
    }
}
