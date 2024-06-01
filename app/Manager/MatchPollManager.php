<?php

declare(strict_types=1);

namespace App\Manager;

use App\Models\MatchPoll;
use App\Repository\MatchPollRepository;
use Illuminate\Database\Eloquent\Collection;

class MatchPollManager
{
    private MatchPollRepository $repository;

    public function __construct(MatchPollRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int[] $matchIds
     *
     * @return int[]
     */
    public function findIdsByMatchIds(array $matchIds): array
    {
        return $this->repository->findIdsByMatchIds($matchIds);
    }

    /**
     * @param int[] $ids
     */
    public function deleteByIds(array $ids): void
    {
        MatchPoll::destroy($ids);
    }

    public function countByMatchId(int $matchId): int
    {
        return $this->repository->countByMatchId($matchId);
    }

    public function findByMatchId(int $matchId): Collection
    {
        return $this->repository->findByMatchId($matchId);
    }
}
