<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Team;

class TeamRepository
{
    public function findStadiumById(int $id): string
    {
        return Team::where('id', $id)->first()->stadium;
    }
}
