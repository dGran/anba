<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\MatchModel;

class MatchRepository
{
    /**
     * @param int[] $clashIds
     *
     * @return int[]
     */
    public function findIdsByClashIds(array $clashIds): array
    {
        return MatchModel::whereIn('clash_id', $clashIds)->pluck('id')->toArray();
    }
}
