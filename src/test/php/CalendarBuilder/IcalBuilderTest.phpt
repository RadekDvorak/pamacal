<?php
declare(strict_types = 1);

namespace RadekDvorak\PamaCal\Parser;

require __DIR__ . '/../../../../vendor/autoload.php';

use Mockery;
use RadekDvorak\PamaCal\CalendarBuilder\IcalBuilder;
use RadekDvorak\PamaCal\Id\UniqueIdGenerator;
use RadekDvorak\PamaCal\Match;
use RadekDvorak\PamaCal\TestCase;
use RadekDvorak\PamaCal\Time\ClockInterface;
use Tester\Assert;

class IcalBuilderTest extends TestCase
{

    public function testCreateCalendar()
    {
        $timeZone = new \DateTimeZone('Europe/Prague');
        $input = [
            new Match('Arsenal', 'Inter Milan', new \DateTime('2016-05-05 20:00:00', $timeZone)),
            new Match('Chelsea', 'VfL Wolfsburg', new \DateTime('2016-05-06 16:00:00', $timeZone)),
        ];

        $clock = $this->mockClock($timeZone);
        $idGenerator = $this->mockIdGenerator();

        $builder = new IcalBuilder($clock, $idGenerator);

        $calendar = $builder->createCalendar(new \ArrayIterator($input));

        Assert::matchFile(__DIR__ . '/calendar.ical', $calendar);
    }

    /**
     * @param \DateTimeZone $timeZone
     * @return ClockInterface
     */
    private function mockClock(\DateTimeZone $timeZone) : ClockInterface
    {
        $clock = Mockery::mock(ClockInterface::class);
        $clock->shouldReceive('now')->andReturnUsing(function () use ($timeZone) {
            return new \DateTime('2016-03-12 12:00:00', $timeZone);
        });

        return $clock;
    }

    /**
     * @return UniqueIdGenerator
     */
    private function mockIdGenerator() : UniqueIdGenerator
    {
        $uniqueIdGenerator = Mockery::mock(UniqueIdGenerator::class);
        $uniqueIdGenerator->shouldReceive('createUniqueId')->andReturnValues(['a123', 'b456']);

        return $uniqueIdGenerator;
    }
}

(new IcalBuilderTest())->run();
