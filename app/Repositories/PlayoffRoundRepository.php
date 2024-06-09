<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\PlayoffClash;
use App\Models\PlayoffRound;

class PlayoffRoundRepository
{
    /**
     * @param int[] $playoffIds
     *
     * @return int[]
     */
    public function findIdsByPlayOffIds(array $playoffIds): array
    {
        return PlayoffRound::whereIn('playoff_id', $playoffIds)->pluck('id')->toArray();
    }

    public function getNextRoundByPlayfoffClash(PlayoffClash $playoffClash): ?PlayoffRound
    {
        return PlayoffRound::where('playoff_id', $playoffClash->round->playoff->id)
            ->where('order', '>', $playoffClash->round->order)
            ->orderBy('order', 'asc')
            ->first();
    }
}
