<?php

declare(strict_types=1);

namespace App\Command;

use App\InPost\InPostManager;
use App\InPost\Point\Filter\FilterFacade;
use App\InPost\Shared\Filter\Filters;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'inpost:fetch-points-by-city')]
class FetchPointsByCityCommand extends Command
{
    public function __construct(
        private readonly InPostManager $inPostManager,
        private readonly FilterFacade $filterFacade,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('city', InputArgument::REQUIRED, 'The city to fetch data for');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $filters = Filters::of($this->filterFacade->createCityFilter($input->getArgument('city')));

        $points = $this->inPostManager->points->findWithFilters($filters);

        var_dump($points->toArray());

        return Command::SUCCESS;
    }
}
