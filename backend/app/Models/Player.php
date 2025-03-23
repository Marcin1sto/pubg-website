<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'players';

    protected $guarded = [];

    protected $hidden = ['created_at', 'deleted_at'];

    const DELAY_TIME = 1;

    /**
     * Get the games for the player.
     */
    public function games(): BelongsToMany
    {
        return $this->belongsToMany(Game::class, 'game_player')
            ->withPivot(['platform', 'is_active'])
            ->withTimestamps();
    }

    public function platforms(): HasMany
    {
        return $this->hasMany(PlayerPlatform::class, 'player_id', 'id');
    }

    // /**
    //  * Player Matches Relationship
    //  *
    //  * @return HasMany
    //  */
    // public function matches(): HasMany
    // {
    //     return $this->hasMany(PlayerMatchStatistic::class, 'player_id', 'id')->orderByDesc('played_at');
    // }

    // /**
    //  * @return Collection
    //  */
    // public function actualSeason()
    // {
    //     $season = $this->games->first()->activeSeason();

    //     return $this->hasMany(PlayerSeasonStatistic::class, 'player_id', 'id')->where('season_id', $season->id);
    // }

    // public function discordRanking()
    // {
    //     $season = $this->games->first()->activeSeason();

    //     return $this->hasMany(PlayerRankingStats::class, 'player_id', 'id')->where('season_id', $season->id);
    // }

    // /**
    //  * Player Matches Relationship
    //  *
    //  * @return HasMany
    //  */
    // public function actualMatches(): HasMany
    // {
    //     $season = $this->games->first()->activeSeason();

    //     return $this->hasMany(PlayerMatchStatistic::class, 'player_id', 'id')->where('season_id', $season->id)->where('type', '!=', 'normal-squad');
    // }

     public function canUpdateMatches(bool $force = false): bool
     {
         if ($force) {
             return true;
         }

         $lastCheckTime = date('Y-m-d H:i:s', strtotime($this->matchesUpdate));
         $delayTime = date('Y-m-d H:i:s', strtotime($lastCheckTime. '+'.self::DELAY_TIME.' hour'));

         if (env('APP_ENV') === 'local') {
             return true;
         }

         return !$this->matchesUpdate || $delayTime <= date('Y-m-d H:i:s');
     }

    // public function canUpdateSeason(): bool
    // {
    //     $lastCheckTime = date('Y-m-d H:i:s', strtotime($this->seasonUpdate));
    //     $delayTime = date('Y-m-d H:i:s', strtotime($lastCheckTime. '+'.self::DELAY_TIME.' hour'));

    //     if (env('APP_ENV') === 'local') {
    //         return true;
    //     }

    //     return !$this->seasonUpdate || $delayTime <= date('Y-m-d H:i:s');
    // }

    // public function canUpdateRanking(): bool
    // {
    //     $lastCheckTime = date('Y-m-d H:i:s', strtotime($this->rankingUpdate));
    //     $delayTime = date('Y-m-d H:i:s', strtotime($lastCheckTime. '+'.self::DELAY_TIME.' hour'));

    //     if (env('APP_ENV') === 'local') {
    //         return true;
    //     }

    //     return !$this->rankingUpdate || $delayTime <= date('Y-m-d H:i:s');
    // }
}
