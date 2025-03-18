<?php

namespace App\Enums;

class PubgMapEnum
{
    const ERANGEL = 'Baltic_Main';
    const MIRAMAR = 'Desert_Main';
    const SANHOK = 'Savage_Main';
    const TAEGO = 'Tiger_Main';
    const VIKENDI = 'DihorOtok_Main';
    const PARAMO = 'Chimera_Main';
    const HAVEN = 'Heaven_Main';
    const DESTON = 'Kiki_Main';
    const KARAKIN = 'Summerland_Main';

    public static function toArray()
    {
        return [
            self::ERANGEL, self::DESTON, self::HAVEN,
            self::MIRAMAR, self::VIKENDI, self::TAEGO,
            self::SANHOK, self::PARAMO, self::KARAKIN
        ];
    }

    public static function getName(string $orgName)
    {
        switch ($orgName) {
            case $orgName == self::ERANGEL:
                return 'Erangel';
            case $orgName == self::MIRAMAR:
                return 'Miramar';
            case $orgName == self::SANHOK:
                return 'Sanhok';
            case $orgName == self::KARAKIN:
                return 'Karakin';
            case $orgName == self::DESTON:
                return 'Deston';
            case $orgName == self::HAVEN:
                return 'Haven';
            case $orgName == self::PARAMO:
                return 'Paramo';
            case $orgName == self::VIKENDI:
                return 'Vikendi';
            case $orgName == self::TAEGO:
                return 'Taego';
        }
    }
}
