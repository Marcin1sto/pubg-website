<?php

namespace Database\Factories;

use App\Models\Player;
use App\Models\PlayerMatchStatistic;
use App\Models\Season;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerMatchesFactory extends Factory
{
    protected $model = PlayerMatchStatistic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'season_id' => Season::all()->first(),
            'player_id' => Player::all()->random()->id,
            'match_id' => $this->faker->uuid,
            'type' => 'squad',
            'idPlayerMatch' => $this->faker->uuid,
            'DBNOs' => 0,
            'assists' => rand(0, 4),
            'boosts' => $this->faker->randomNumber(),
            'damageDealt' => $this->faker->randomNumber(4),
            'deathType' => array_rand([null, 'by-player']),
            'headshotKills' => rand(0, 5),
            'heals' => rand(0, 5),
            'killPlace' => rand(0, 100),
            'killStreaks' => rand(0, 25),
            'kills' => rand(0, 25),
            'longestKill' => rand(0, 500),
            'name' => '?????',
            'revives' => rand(0, 5),
            'rideDistance' => rand(0, 5000),
            'swimDistance' => rand(0, 1000),
            'walkDistance' => rand(0, 3000),
            'roadKills' => rand(0, 5),
            'teamKills' => rand(0, 20),
            'timeSurvived' => rand(0, 45),
            'vehicleDestroys' => rand(0, 4),
            'weaponsAcquired' => rand(0, 4),
            'winPlace' => rand(1, 24),
        ];
    }
}
