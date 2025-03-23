<?php

namespace App\Models;

use App\Enums\PubgMapEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlayerMatchStatistic extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'player_match_statistic';

    protected $guarded = [];

    protected $hidden = ['player_id'];

    protected $casts = [
        'mapName' => PubgMapEnum::class,
    ];

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class, 'season_id', 'id');
    }
}
