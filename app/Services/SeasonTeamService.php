<?php

declare(strict_types=1);

namespace App\Services;

use App\Managers\MatchManager;
use App\Managers\PlayerStatManager;
use App\Managers\TeamStatManager;
use App\Managers\TransferManager;
use App\Models\MatchModel;
use App\Models\PlayerStat;
use App\Models\SeasonTeam;
use App\Models\TeamStat;

class SeasonTeamService
{
    private TransferManager $transferManager;

    private TeamStatManager $teamStatManager;

    private PlayerStatManager $playerStatManager;

    private MatchManager $matchManager;

    public function __construct(
        TransferManager $transferManager,
        TeamStatManager $teamStatManager,
        PlayerStatManager $playerStatManager,
        MatchManager $matchManager
    ) {
        $this->transferManager = $transferManager;
        $this->teamStatManager = $teamStatManager;
        $this->playerStatManager = $playerStatManager;
        $this->matchManager = $matchManager;
    }

    public function getName(SeasonTeam $seasonTeam): string
    {
        return $seasonTeam->getSeason()->getName().' - '.$seasonTeam->getTeam()->getName();
    }

    public function isCanDestroy(SeasonTeam $seasonTeam): bool
    {
        $seasonTeamId = $seasonTeam->getId();

        $countTransferSeasonTeam = $this->transferManager->countSeasonTeamUses($seasonTeamId);

        if ($countTransferSeasonTeam > 0) {
            return false;
        }

        $countTeamStatSeasonTeam = $this->teamStatManager->countSeasonTeamUses($seasonTeamId);

        if ($countTeamStatSeasonTeam > 0) {
            return false;
        }

        $countTeamStatSeasonStat = $this->playerStatManager->countSeasonTeamUses($seasonTeamId);

        if ($countTeamStatSeasonStat > 0) {
            return false;
        }

        $countMatchSeasonTeam = $this->matchManager->countSeasonTeamUses($seasonTeamId);

        if ($countMatchSeasonTeam > 0) {
            return false;
        }

        return true;

        if (TeamStat::where('season_team_id', $seasonTeam->getId())->count() > 0) { return false; }
        if (PlayerStat::where('season_team_id', $seasonTeam->getId())->count() > 0) { return false; }
        if (MatchModel::where('local_team_id', $seasonTeam->getId())->orWhere('visitor_team_id', $seasonTeam->getId())->count() > 0) { return false; }

        // TODO: RoundParticipant, RoundClash

        return true;
    }
}
