<?php

declare(strict_types=1);

namespace App\Managers;

use App\Models\Season;
use App\Repositories\SeasonRepository;

class SeasonManager
{
    private SeasonRepository $repository;

    public function __construct(SeasonRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findOneById(int $seasonId): ?Season
    {
        return $this->repository->findOneById($seasonId);
    }

    public function getCurrentSeason(): ?Season
    {
        return $this->repository->getCurrentSeason();
    }
}
