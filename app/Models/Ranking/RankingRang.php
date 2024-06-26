<?php

namespace App\Models\Ranking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RankingRang extends Model
{
    use HasFactory;

    protected $table = 'ranking_ranks';

    protected $guarded = [];

    public static function getRang(int $points): ?RankingRang
    {
        return RankingRang::where('from', '<=', $points)->where('to', '>=', $points)->first();
    }
}
