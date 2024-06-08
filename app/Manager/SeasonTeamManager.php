<?php

declare(strict_types=1);

namespace App\Manager;

use App\Models\SeasonTeam;
use App\Repository\SeasonTeamRepository;

class SeasonTeamManager
{
    private SeasonTeamRepository $repository;

    public function __construct(SeasonTeamRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(): SeasonTeam
    {
        return new SeasonTeam();
    }

    public function save(SeasonTeam $seasonTeam): void
    {
        $seasonTeam->save();
    }

    public function update(SeasonTeam $seasonTeam): void
    {
        $seasonTeam->setUpdatedAt(new \DateTime());
        $seasonTeam->save();
    }

    public function findOneById(int $seasonId): ?SeasonTeam
    {
        return $this->repository->findOneById($seasonId);
    }
}
