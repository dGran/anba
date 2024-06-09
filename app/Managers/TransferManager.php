<?php

declare(strict_types=1);

namespace App\Managers;

use App\Repositories\TransferRepository;

class TransferManager
{
    private TransferRepository $repository;

    public function __construct(TransferRepository $repository)
    {
        $this->repository = $repository;
    }

    public function countSeasonTeamUses(int $seasonTeamId): int
    {
        return $this->repository->countSeasonTeamUses($seasonTeamId);
    }
}
