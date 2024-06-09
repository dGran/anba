<?php

declare(strict_types=1);

namespace App\Managers;

use App\Models\SeasonDivision;
use App\Repositories\SeasonDivisionRepository;

class SeasonDivisionManager
{
    private SeasonDivisionRepository $repository;

    public function __construct(SeasonDivisionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findOneById(int $seasonId): ?SeasonDivision
    {
        return $this->repository->findOneById($seasonId);
    }
}
