<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\MatchPoll;
use Illuminate\Database\Eloquent\Collection;

class MatchPollRepository
{
    /**
     * @param int[] $matchIds
     *
     * @return int[]
     */
    public function findIdsByMatchIds(array $matchIds): array
    {
        return MatchPoll::whereIn('match_id', $matchIds)->pluck('id')->toArray();
    }

    public function countByMatchId(int $matchId): int
    {
        return MatchPoll::where('match_id', $matchId)->count();
    }

    public function findByMatchId(int $matchId): Collection
    {
        return MatchPoll::where('match_id', $matchId)->get();
    }
}
