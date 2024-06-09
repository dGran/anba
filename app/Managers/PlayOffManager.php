<?php

declare(strict_types=1);

namespace App\Managers;

use App\Models\Playoff;
use App\Repositories\PlayoffRepository;

class PlayOffManager
{
    private PlayoffRepository $repository;

    public function __construct(PlayoffRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(
        int $seasonId,
        string $name,
        int $order,
        int $numParticipants,
        bool $fullBracket,
        ?int $playInPlace = null,
        ?int $seasonConferenceId = null
    ): Playoff {
        return Playoff::create([
            'season_id' => $seasonId,
            'name' => $name,
            'playin_place' => $playInPlace,
            'season_conference_id' => $seasonConferenceId,
            'order' => $order,
            'num_participants' => $numParticipants,
            'full_bracket' => $fullBracket,
        ]);
    }

    /**
     * @return int[]
     */
    public function findIdsBySeasonId(int $seasonId): array
    {
        return $this->repository->findIdsBySeasonId($seasonId);
    }

    /**
     * @param int[] $ids
     */
    public function deleteByIds(array $ids): void
    {
        Playoff::destroy($ids);
    }
}
