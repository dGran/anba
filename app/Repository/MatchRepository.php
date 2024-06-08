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

    /**
     * @return MatchModel[]
     */
    public function getLastMatchesBySeasonTeamId(int $seasonTeamId, ?int $limit = MatchModel::DEFAULT_LAST_MATCHES_LIMIT): array
    {
        $matches = MatchModel::
            leftJoin('scores', 'scores.match_id', 'matches.id')
            ->where(function ($query) use ($seasonTeamId) {
                $query->where('local_team_id', $seasonTeamId)
                    ->orWhere('visitor_team_id', $seasonTeamId);
            })
            ->whereNotNull('scores.match_id')
            ->with(['localTeam', 'visitorTeam'])
            ->orderBy('scores.created_at', 'desc')
            ->take($limit)
            ->get();

        return $matches->all();
    }
}
