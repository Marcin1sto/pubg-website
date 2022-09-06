<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlayerSeasonStatistic extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'player_season_statistic';

    protected $guarded = [];
}
