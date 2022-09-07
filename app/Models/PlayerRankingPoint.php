<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlayerRankingPoint extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'players_ranking_points';

    protected $guarded = [];

    /**
     * @return HasOne
     */
    public function player(): HasOne
    {
        return $this->hasOne(Player::class, 'id', 'player_id');
    }
}
