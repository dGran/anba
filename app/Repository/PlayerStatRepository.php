<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\PlayerStat;

class PlayerStatRepository
{
    /**
     * @param int[] $matchIds
     *
     * @return int[]
     */
    public function findIdsByMatchIds(array $matchIds): array
    {
        return PlayerStat::whereIn('match_id', $matchIds)->pluck('id')->toArray();
    }
}
