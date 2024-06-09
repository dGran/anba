<?php

declare(strict_types=1);

namespace App\Managers;

use App\Models\SeasonConference;
use App\Repositories\SeasonConferenceRepository;
use Illuminate\Database\Eloquent\Collection;

class SeasonConferenceManager
{
    private SeasonConferenceRepository $repository;

    public function __construct(SeasonConferenceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findBySeasonId(int $seasonId): Collection
    {
        return $this->repository->findBySeasonId($seasonId);
    }

    public function findBySeasonIdAndConferenceId(int $seasonId, int $conferenceId): ?SeasonConference
    {
        return $this->repository->findBySeasonIdAndConferenceId($seasonId, $conferenceId);
    }
}
