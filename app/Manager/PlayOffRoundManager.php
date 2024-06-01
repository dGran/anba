<?php

declare(strict_types=1);

namespace App\Manager;

use App\Models\PlayoffClash;
use App\Models\PlayoffRound;
use App\Repository\PlayoffRoundRepository;

class PlayOffRoundManager
{
    private PlayoffRoundRepository $repository;

    public function __construct(PlayoffRoundRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(int $playOffId, string $name, int $matchesToWin, int $matchesMax, int $order): PlayoffRound
    {
        return PlayoffRound::create([
            'playoff_id' => $playOffId,
            'name' => $name,
            'matches_to_win' => $matchesToWin,
            'matches_max' => $matchesMax,
            'order' => $order,
        ]);
    }

    /**
     * @param int[] $playoffIds
     *
     * @return int[]
     */
    public function findIdsByPlayOffIds(array $playoffIds): array
    {
        return $this->repository->findIdsByPlayOffIds($playoffIds);
    }

    /**
     * @param int[] $ids
     */
    public function deleteByIds(array $ids): void
    {
        PlayoffRound::destroy($ids);
    }

    public function getNextRoundByPlayfoffClash(PlayoffClash $playoffClash): ?PlayoffRound
    {
        return $this->repository->getNextRoundByPlayfoffClash($playoffClash);
    }
}
