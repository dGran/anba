<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\TeamStat;

class TeamStatRepository
{
    /**
     * @param int[] $matchIds
     *
     * @return int[]
     */
    public function findIdsByMatchIds(array $matchIds): array
    {
        return TeamStat::whereIn('match_id', $matchIds)->pluck('id')->toArray();
    }

    public function countSeasonTeamUses(int $seasonTeamId): int
    {
        return TeamStat::where('season_team_id', $seasonTeamId)->count();
    }
}
