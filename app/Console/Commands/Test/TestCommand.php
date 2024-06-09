<?php

namespace App\Console\Commands\Test;

use App\Managers\MatchManager;
use App\Managers\SeasonDivisionManager;
use App\Managers\SeasonManager;
use App\Managers\SeasonTeamManager;
use App\Managers\TeamManager;
use App\Models\MatchModel;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

class TestCommand extends Command
{
    protected $signature = 'test:command';

    protected $description = 'Command test';

    private SeasonTeamManager $seasonTeamManager;

    private SeasonManager $seasonManager;

    private TeamManager $teamManager;

    private SeasonDivisionManager $seasonDivisionManager;

    private MatchManager $matchManager;

    public function __construct(
        SeasonTeamManager $seasonTeamManager,
        SeasonManager $seasonManager,
        TeamManager $teamManager,
        SeasonDivisionManager $seasonDivisionManager,
        MatchManager $matchManager
    ) {
        parent::__construct();

        $this->seasonTeamManager = $seasonTeamManager;
        $this->seasonManager = $seasonManager;
        $this->teamManager = $teamManager;
        $this->seasonDivisionManager = $seasonDivisionManager;
        $this->matchManager = $matchManager;
    }

    /**
     * @throws \Exception
     */
    public function handle(): int
    {
        $season = $this->seasonManager->findOneById(3);
        $team = $this->teamManager->findOneById(1);
        $seasonDivision = $this->seasonDivisionManager->findOneById(13);

        $seasonTeam = $this->seasonTeamManager->create();
        $seasonTeam->setSeason($season);
        $seasonTeam->setTeam($team);
        $seasonTeam->setSeasonDivision($seasonDivision);

        dump($seasonTeam->getSeason());die;

        return SymfonyCommand::SUCCESS;
    }
}
