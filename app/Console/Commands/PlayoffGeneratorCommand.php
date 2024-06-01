<?php

namespace App\Console\Commands;

use App\Manager\SeasonManager;
use App\Service\PlayOffService;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

class PlayoffGeneratorCommand extends Command
{
    protected $signature = 'playoff-generator {--seasonId=}';

    protected $description = 'Command description';

    private PlayOffService $playOffService;
    private SeasonManager $seasonManager;

    public function __construct(PlayOffService $playOffService, SeasonManager $seasonManager)
    {
        parent::__construct();

        $this->playOffService = $playOffService;
        $this->seasonManager = $seasonManager;
    }

    public function handle(): int
    {
        $seasonId = $this->option('seasonId');

        if ($seasonId === null) {
            $this->output->writeln(\date(DATE_W3C).' - Parameter seasonId it\'s a mandatory parameter');

            return SymfonyCommand::FAILURE;
        }

        $season = $this->seasonManager->findOneById((int)$seasonId);

        if ($season === null) {
            $this->output->writeln(\date(DATE_W3C).' - Season not found with seasonId: '.$seasonId);

            return SymfonyCommand::FAILURE;
        }

        $this->output->writeln(\date(DATE_W3C).' - Generate Playoffs process start....');
        $this->playOffService->generateSeasonPlayOffs($season, $this->output);
        $this->output->writeln(\date(DATE_W3C).' - Generate Playoffs process end');

        return SymfonyCommand::SUCCESS;
    }
}
