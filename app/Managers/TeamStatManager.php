<?php

declare(strict_types=1);

namespace App\Managers;

use App\Models\TeamStat;
use App\Repositories\TeamStatRepository;

class TeamStatManager
{
    private TeamStatRepository $repository;

    public function __construct(TeamStatRepository $repository)
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
        TeamStat::destroy($ids);
    }

    public function countSeasonTeamUses(int $seasonTeamId): int
    {
        return $this->repository->countSeasonTeamUses($seasonTeamId);
    }
}
