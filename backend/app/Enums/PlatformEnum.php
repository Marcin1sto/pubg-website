<?php

namespace App\Enums;

class PlatformEnum
{
    const STEAM = 'steam';

    const PSN = 'psn';

    const XBOX = 'xbox';

    public static function toArray(): array
    {
        return [
            self::STEAM, self::PSN, self::XBOX
        ];
    }
}
