<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Season;

class SeasonRepository
{
    public function findOneById(int $seasonId): ?Season
    {
        return Season::find($seasonId);
    }

    public function getCurrentSeason(): ?Season
    {
        return Season::where('current', true)->first();
    }
}
