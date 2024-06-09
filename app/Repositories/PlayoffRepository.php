<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Playoff;

class PlayoffRepository
{
    /**
     * @return int[]
     */
    public function findIdsBySeasonId(int $seasonId): array
    {
        return Playoff::where('season_id', $seasonId)->pluck('id')->toArray();
    }
}
