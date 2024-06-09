<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\SeasonDivision;

class SeasonDivisionRepository
{
    public function findOneById(int $seasonDivisionId): ?SeasonDivision
    {
        return SeasonDivision::find($seasonDivisionId);
    }
}
