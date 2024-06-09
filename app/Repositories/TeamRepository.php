<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Team;

class TeamRepository
{
    public function findOneById(int $teamId): ?Team
    {
        return Team::find($teamId);
    }

    public function findStadiumById(int $id): string
    {
        return Team::where('id', $id)->first()->stadium;
    }
}
