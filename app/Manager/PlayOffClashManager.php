<?php

declare(strict_types=1);

namespace App\Manager;

use App\Models\PlayoffClash;
use App\Repository\PlayoffClashRepository;

class PlayOffClashManager
{
    private PlayoffClashRepository $repository;

    public function __construct(PlayoffClashRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array{team_id: int, manager_id: int, regular_position: int} $localData
     * @param array{team_id: int, manager_id: int, regular_position: int} $visitorData
     */
    public function create(
        int $roundId,
        array $localData,
        array $visitorData,
        int $order,
        ?int $destinyClash = null,
        ?bool $destinyClashLocal = null,
        ?int $destinyPlayoffId = null,
        ?int $loserDestinyClash = null,
        ?bool $loserDestinyClashLocal = null,
        ?int $loserDestinyPlayoffId = null
    ): PlayoffClash {
        return  PlayoffClash::create([
            'round_id' => $roundId,
            'local_team_id'	=> $localData['team_id'] ?? null,
            'local_manager_id'	=> $localData['manager_id'] ?? null,
            'visitor_team_id' => $visitorData['team_id'] ?? null,
            'visitor_manager_id'	=> $visitorData['manager_id'] ?? null,
            'regular_position_local' => $localData['regular_position'] ?? null,
            'regular_position_visitor' => $visitorData['regular_position'] ?? null,
            'order' => $order,
            'destiny_clash' => $destinyClash,
            'destiny_clash_local' => $destinyClashLocal,
            'destiny_playoff_id' => $destinyPlayoffId,
            'loser_destiny_clash' => $loserDestinyClash,
            'loser_destiny_clash_local' => $loserDestinyClashLocal,
            'loser_destiny_playoff_id' => $loserDestinyPlayoffId,
        ]);
    }

    /**
     * @param int[] $roundIds
     *
     * @return int[]
     */
    public function findIdsByRoundIds(array $roundIds): array
    {
        return $this->repository->findIdsByRoundIds($roundIds);
    }

    /**
     * @param int[] $ids
     */
    public function deleteByIds(array $ids): void
    {
        PlayoffClash::destroy($ids);
    }
}
