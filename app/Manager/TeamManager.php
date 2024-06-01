<?php

declare(strict_types=1);

namespace App\Manager;

use App\Repository\TeamRepository;

class TeamManager
{
    private TeamRepository $repository;

    public function __construct(TeamRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findStadiumById(int $seasonId): string
    {
        return $this->repository->findStadiumById($seasonId);
    }
}
