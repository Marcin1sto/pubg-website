<?php

namespace App\Models\Ranking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoostRankingStat extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $hidden = ['id'];

    protected $fillable = ['stat_type', 'count'];

    public function scopeGetStatType($query, string $statType): void
    {
        $query->where('stat_type', $statType);
    }
}
