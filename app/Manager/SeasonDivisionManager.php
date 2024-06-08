<?php

declare(strict_types=1);

namespace App\Manager;

use App\Models\SeasonDivision;
use App\Repository\SeasonDivisionRepository;

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
