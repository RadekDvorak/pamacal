<?php
declare(strict_types = 1);

namespace RadekDvorak\PamaCal;

use RadekDvorak\PamaCal\CalendarBuilder\IcalBuilder;
use RadekDvorak\PamaCal\Filter\TeamMatchFilter;
use RadekDvorak\PamaCal\Id\UniqueIdGenerator;
use RadekDvorak\PamaCal\Loader\SimpleLoader;
use RadekDvorak\PamaCal\Parser\Web2016Parser;
use RadekDvorak\PamaCal\Saver\SimpleSaver;
use RadekDvorak\PamaCal\Time\SystemClock;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateCalendarCommand extends Command
{

    protected function configure()
    {
        $this->setName('create-calendar')
            ->setDescription('Creates calendar')
            ->addArgument('teamName', InputArgument::REQUIRED)
            ->addArgument('sourceUrl', InputArgument::REQUIRED)
            ->addArgument('destinationFile', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $teamName = $input->getArgument('teamName');
        $calendarCreator = new CalendarCreator(
            new SimpleLoader(),
            new Web2016Parser(),
            new IcalBuilder(new SystemClock(), new UniqueIdGenerator()),
            new SimpleSaver(),
            new TeamMatchFilter($teamName)
        );

        $sourceUrl = $input->getArgument('sourceUrl');
        $targetUrl = $input->getArgument('destinationFile');

        $calendarCreator->createCalendar($sourceUrl, $targetUrl);
    }
}
