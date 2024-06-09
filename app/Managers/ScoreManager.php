<?php

declare(strict_types=1);

namespace App\Managers;

use App\Models\Score;
use App\Repositories\ScoreRepository;

class ScoreManager
{
    private ScoreRepository $repository;

    public function __construct(ScoreRepository $repository)
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
        Score::destroy($ids);
    }
}
