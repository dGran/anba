<?php

declare(strict_types=1);

namespace App\Managers;

use App\Models\Team;
use App\Repositories\TeamRepository;

class TeamManager
{
    private TeamRepository $repository;

    public function __construct(TeamRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findOneById(int $teamId): ?Team
    {
        return $this->repository->findOneById($teamId);
    }

    public function findStadiumById(int $seasonId): string
    {
        return $this->repository->findStadiumById($seasonId);
    }
}
