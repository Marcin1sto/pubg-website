<?php

namespace App\Enums;

class MatchGameModeEnum
{
    const SQUAD_FPP = 'squad-fpp';
    const DUO_FPP = 'duo-fpp';
    const SOLO_FPP = 'solo-fpp';
    const SQUAD = 'squad';
    const DUO = 'duo';
    const SOLO = 'solo';

    const PARENT_TPP = 'tpp';
    const PARENT_FPP = 'fpp';
    const PARENT_RANKED = 'ranked';

    public static function parentModes()
    {
        return ['tpp', 'fpp', 'ranked'];
    }

    public static function TppModes()
    {
        return [
          self::DUO, self::SOLO, self::SQUAD
        ];
    }

    public static function FppModes()
    {
        return [
            self::DUO_FPP, self::SOLO_FPP, self::SQUAD_FPP
        ];
    }
}
