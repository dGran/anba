<?php

declare(strict_types=1);

namespace App\Managers;

use App\Models\PlayerStat;
use App\Repositories\PlayerStatRepository;

class PlayerStatManager
{
    private PlayerStatRepository $repository;

    public function __construct(PlayerStatRepository $repository)
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
        PlayerStat::destroy($ids);
    }
}