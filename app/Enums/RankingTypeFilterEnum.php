<?php

namespace App\Enums;

class RankingTypeFilterEnum
{
    const KDA_FILTER = 'kda';
    const KD_FILTER = 'kd';
    const ADR_FILTER = 'adr';

    public function toArray() {
        return [
            self::KD_FILTER, self::KDA_FILTER, self::ADR_FILTER
        ];
    }
}
