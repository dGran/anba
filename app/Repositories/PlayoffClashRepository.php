<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\PlayoffClash;

class PlayoffClashRepository
{
    /**
     * @param int[] $roundIds
     *
     * @return int[]
     */
    public function findIdsByRoundIds(array $roundIds): array
    {
        return PlayoffClash::whereIn('round_id', $roundIds)->pluck('id')->toArray();
    }
}
