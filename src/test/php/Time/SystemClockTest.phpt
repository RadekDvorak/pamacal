<?php
declare(strict_types = 1);

namespace RadekDvorak\PamaCal\Saver;

require __DIR__ . '/../../../../vendor/autoload.php';

use RadekDvorak\PamaCal\TestCase;
use RadekDvorak\PamaCal\Time\SystemClock;
use Tester\Assert;

class SystemClockTest extends TestCase
{

    public function testNow()
    {
        $clock = new SystemClock();

        $now = $clock->now();
        $then = $clock->now();

        Assert::type(\DateTime::class, $now);
        Assert::type(\DateTime::class, $then);

        Assert::notSame($now, $then);
        Assert::true($then >= $now, 'Time does not go backwards.');
    }
}

(new SystemClockTest())->run();
