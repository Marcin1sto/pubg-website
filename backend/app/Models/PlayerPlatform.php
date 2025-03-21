<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlayerPlatform extends Model
{
    use HasFactory;

    protected $fillable = [
        'player_id',
        'platform',
        'playerName',
        'clanId'
    ];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }
}
