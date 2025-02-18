<?php

namespace App\Enums;

enum GamesEnum: string
{
    case PUBG = 'pubg';
    case PUBG_MOBILE = 'pubg-mobile';
    case FORTNITE = 'fortnite';
    case APEX = 'apex';
    case WARZONE = 'warzone';
    case CSGO = 'csgo';
    case VALORANT = 'valorant';
    case ROCKET_LEAGUE = 'rocket-league';
    case RAINBOW_SIX = 'rainbow-six';
    case OVERWATCH = 'overwatch';
    case LEAGUE_OF_LEGENDS = 'league-of-legends';
    case DOTA = 'dota';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
