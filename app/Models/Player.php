<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'players';

    protected $guarded = [];

    /**
     * Player Matches Relationship
     *
     * @return HasMany
     */
    public function matches(): HasMany
    {
        return $this->hasMany(PlayerMatchStatistic::class, 'player_id', 'id');
    }

    /**
     * @return Collection
     */
    public function actualSeason()
    {
        $season = Season::where('isCurrentSeason', true)->first();

        return $this->hasMany(PlayerSeasonStatistic::class, 'player_id', 'id')->where('season_id', $season->id);
    }

    /**
     * Player Matches Relationship
     *
     * @return HasMany
     */
    public function actualMatches(): HasMany
    {
        $season = Season::where('isCurrentSeason', true)->first();

        return $this->hasMany(PlayerMatchStatistic::class, 'player_id', 'id')->where('season_id', $season->id);
    }
}
