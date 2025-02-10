<?php

namespace App\Models;

use App\Models\Ranking\RankingRang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlayerRankingStats extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'player_stats';

    protected $guarded = [];

    protected $hidden = ['id', 'created_at', 'deleted_at', 'player_id'];

    public function rang()
    {
        return $this->hasOne(RankingRang::class, 'id', 'rang_id');
    }

    /**
     * @return HasOne
     */
    public function player(): HasOne
    {
        return $this->hasOne(Player::class, 'id', 'player_id');
    }
}
