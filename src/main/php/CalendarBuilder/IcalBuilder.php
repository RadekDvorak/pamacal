<?php
declare(strict_types = 1);

namespace RadekDvorak\PamaCal\CalendarBuilder;

use Eluceo\iCal\Component\Calendar;
use Eluceo\iCal\Component\Event;
use RadekDvorak\PamaCal\Id\UniqueIdGenerator;
use RadekDvorak\PamaCal\Match;
use RadekDvorak\PamaCal\Time\ClockInterface;

class IcalBuilder implements CalendarBuilderInterface
{

    private $gameDurationModifier = '+55 minutes';

    /**
     * @var ClockInterface
     */
    private $clock;

    /**
     * @var UniqueIdGenerator
     */
    private $uniqueIdGenerator;

    public function __construct(ClockInterface $clock, UniqueIdGenerator $uniqueIdGenerator)
    {
        $this->clock = $clock;
        $this->uniqueIdGenerator = $uniqueIdGenerator;
    }

    /**
     * @inheritdoc
     */
    public function createCalendar(\Traversable $matches) : string
    {
        $calendar = new Calendar('Rozpis zápasů');
        $now = $this->clock->now();

        /** @var Match $match */
        foreach ($matches as $match) {
            $id = $this->uniqueIdGenerator->createUniqueId();
            $event = new Event($id);
            $description = sprintf('Pamako %s:%s', $match->getHomeTeam(), $match->getAwayTeam());
            $event->setDtStart($match->getDate())
                ->setDtStamp($now)
                ->setDtEnd($match->getDate()->modify($this->gameDurationModifier))
                ->setSummary('Zápas Pamako')
                ->setDescription($description);

            $event->setUseUtc(false);
            $event->setUseTimezone(true);

            $calendar->addComponent($event);
        }

        return $calendar->render();
    }
}
