<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Season extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'seasons';

    protected $guarded = [];

    protected $casts = [
        'isCurrentSeason' => 'bool'
    ];

    /**
     * Get the game that owns the season.
     */
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * Get the player statistics for the season.
     */
    public function playerStatistics(): HasMany
    {
        return $this->hasMany(PlayerSeasonStatistic::class);
    }

    /**
     * Get the player rankings for the season.
     */
    public function playerRankings(): HasMany
    {
        return $this->hasMany(PlayerRankingStats::class);
    }

    /**
     * Get the player matches for the season.
     */
    public function playerMatches(): HasMany
    {
        return $this->hasMany(PlayerMatchStatistic::class);
    }

    /**
     * Scope a query to only include current season.
     */
    public function scopeCurrent($query)
    {
        return $query->where('isCurrentSeason', true);
    }

    /**
     * Scope a query to only include seasons for a specific game.
     */
    public function scopeForGame($query, $gameId)
    {
        return $query->where('game_id', $gameId);
    }
}
