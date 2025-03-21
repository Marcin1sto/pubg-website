<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'api_key',
        'api_url',
        'is_active'
    ];

    protected $casts = [
        'api_config' => 'array',
        'is_active' => 'boolean'
    ];

    /**
     * Get the players for the game.
     */
    public function players(): BelongsToMany
    {
        return $this->belongsToMany(Player::class, 'game_player')
            ->withPivot(['platform', 'api_id', 'is_active'])
            ->withTimestamps();
    }

    /**
     * Get the seasons for the game.
     */
    public function seasons(): HasMany
    {
        return $this->hasMany(Season::class);
    }

    /**
     * Get the active season for the game.
     */
    public function activeSeason()
    {
        return $this->seasons()->where('isCurrentSeason', true)->first();
    }

    /**
     * Scope a query to only include active games.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include games with a specific slug.
     */
    public function scopeWithSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }
}
