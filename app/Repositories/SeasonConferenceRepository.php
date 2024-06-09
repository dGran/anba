<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\SeasonConference;
use Illuminate\Database\Eloquent\Collection;

class SeasonConferenceRepository
{
    public function findBySeasonId(int $seasonId): Collection
    {
        return SeasonConference::
           leftJoin('conferences', 'conferences.id', 'seasons_conferences.conference_id')
            ->select('seasons_conferences.*', 'conferences.name')
            ->where('season_id', $seasonId)
            ->orderBy('conferences.name')
            ->get()
        ;
    }

    public function findBySeasonIdAndConferenceId(int $seasonId, int $conferenceId): ?SeasonConference
    {
        return SeasonConference::
            select('seasons_conferences.*')
            ->where('season_id', $seasonId)
            ->where('conference_id', $conferenceId)
            ->first()
        ;
    }
}
