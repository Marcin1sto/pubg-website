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

    protected $hidden = ['id', 'created_at', 'deleted_at', 'matchesUpdate', 'seasonUpdate', 'rankingUpdate'];

    const DELAY_TIME = 1;

    /**
     * Player Matches Relationship
     *
     * @return HasMany
     */
    public function matches(): HasMany
    {
        return $this->hasMany(PlayerMatchStatistic::class, 'player_id', 'id')->orderByDesc('played_at');
    }

    /**
     * @return Collection
     */
    public function actualSeason()
    {
        $season = Season::where('isCurrentSeason', true)->first();

        return $this->hasMany(PlayerSeasonStatistic::class, 'player_id', 'id')->where('season_id', $season->id);
    }

    public function discordRanking()
    {
        return $this->hasOne(PlayerRankingStats::class, 'player_id', 'id');
    }

    /**
     * Player Matches Relationship
     *
     * @return HasMany
     */
    public function actualMatches(): HasMany
    {
        $season = Season::where('isCurrentSeason', true)->first();

        return $this->hasMany(PlayerMatchStatistic::class, 'player_id', 'id')->where('season_id', $season->id)->where('type', '!=', 'custom');
    }

    public function canUpdateMatches(): bool
    {
        $lastCheckTime = date('Y-m-d H:i:s', strtotime($this->matchesUpdate));
        $delayTime = date('Y-m-d H:i:s', strtotime($lastCheckTime. '+'.self::DELAY_TIME.' hour'));

        if (env('APP_ENV') === 'local') {
            return true;
        }

        return !$this->matchesUpdate || $delayTime <= date('Y-m-d H:i:s');
    }


    public function canUpdateSeason(): bool
    {
        $lastCheckTime = date('Y-m-d H:i:s', strtotime($this->seasonUpdate));
        $delayTime = date('Y-m-d H:i:s', strtotime($lastCheckTime. '+'.self::DELAY_TIME.' hour'));

        if (env('APP_ENV') === 'local') {
            return true;
        }

        return !$this->seasonUpdate || $delayTime <= date('Y-m-d H:i:s');
    }

    public function canUpdateRanking(): bool
    {
        $lastCheckTime = date('Y-m-d H:i:s', strtotime($this->rankingUpdate));
        $delayTime = date('Y-m-d H:i:s', strtotime($lastCheckTime. '+'.self::DELAY_TIME.' hour'));

        if (env('APP_ENV') === 'local') {
            return true;
        }

        return !$this->rankingUpdate || $delayTime <= date('Y-m-d H:i:s');
    }
}
