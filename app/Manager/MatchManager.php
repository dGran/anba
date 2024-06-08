<?php

declare(strict_types=1);

namespace App\Manager;

use App\Models\MatchModel;
use App\Repository\MatchRepository;

class MatchManager
{
    private const STATS_STATE_SUCCESS = 'success';

    private const STATS_STATE_WARNING = 'warning';

    private const STATS_STATE_ERROR = 'error';

    private MatchRepository $repository;

    private SeasonTeamManager $seasonTeamManager;

    private TeamManager $teamManager;

    public function __construct(
        MatchRepository $repository,
        SeasonTeamManager $seasonTeamManager,
        TeamManager $teamManager
    ) {
        $this->repository = $repository;
        $this->seasonTeamManager = $seasonTeamManager;
        $this->teamManager = $teamManager;
    }

    /**
     * @param array{team_id: int, manager_id: int} $localData
     * @param array{team_id: int, manager_id: int} $visitorData
     */
    public function create(
        int $seasonId,
        array $localData,
        array $visitorData,
        ?int $clashId = null,
        ?string $teamStatsState = null,
        ?string $playerStatsState = null
    ): void {
        if (empty($localData) || empty($visitorData)) {
            return;
        }

        $stadium = $this->getStadiumNameByTeamId((int)$localData['team_id']);

        MatchModel::create([
            'season_id' => $seasonId,
            'clash_id' => $clashId,
            'local_team_id' => $localData['team_id'],
            'local_manager_id' => $localData['manager_id'],
            'visitor_team_id' => $visitorData['team_id'],
            'visitor_manager_id' => $visitorData['manager_id'],
            'stadium' => $stadium,
            'extra_times' => 0,
            'played' => 0,
            'teamStats_state' => $teamStatsState ?? self::STATS_STATE_ERROR,
            'playerStats_state' => $playerStatsState ?? self::STATS_STATE_ERROR,
        ]);
    }

    private function getStadiumNameByTeamId(int $teamId): ?string
    {
        $seasonTeam = $this->seasonTeamManager->findOneById($teamId);

        if ($seasonTeam === null) {
            return '';
        }

        return $this->teamManager->findStadiumById($seasonTeam->team->id);
    }

    /**
     * @param int[] $clashIds
     *
     * @return int[]
     */
    public function findIdsByClashIds(array $clashIds): array
    {
        return $this->repository->findIdsByClashIds($clashIds);
    }

    /**
     * @param int[] $ids
     */
    public function deleteByIds(array $ids): void
    {
        MatchModel::destroy($ids);
    }

    /**
     * @return MatchModel[]
     */
    public function getLastMatchesBySeasonTeamId(int $seasonTeamId, ?int $limit = MatchModel::DEFAULT_LAST_MATCHES_LIMIT): array
    {
        return $this->repository->getLastMatchesBySeasonTeamId($seasonTeamId, $limit);
    }
}
