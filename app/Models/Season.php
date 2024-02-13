<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orchid\Screen\AsMultiSource;
use Orchid\Screen\AsSource;

class Season extends Model
{
    use HasFactory, SoftDeletes, AsMultiSource;

    protected $table = 'seasons';

    protected $guarded = [];

    protected $casts = [
        'isCurrentSeason' => 'bool'
    ];

//    public function getContent($permision)
//    {
//        dd($permision);
//        return false;
//    }
}
