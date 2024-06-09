<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Score;

class ScoreRepository
{
    /**
     * @param int[] $matchIds
     *
     * @return int[]
     */
    public function findIdsByMatchIds(array $matchIds): array
    {
        return Score::whereIn('match_id', $matchIds)->pluck('id')->toArray();
    }
}
