<?php
declare(strict_types = 1);

namespace RadekDvorak\PamaCal\Parser;

require __DIR__ . '/../../../../vendor/autoload.php';

use RadekDvorak\PamaCal\Match;
use RadekDvorak\PamaCal\TestCase;
use Tester\Assert;

class Web2016ParserTest extends TestCase
{

    public function testParse()
    {
        $input = __DIR__ . '/schedule.html';
        $html = file_get_contents($input);

        $parser = new Web2016Parser();

        Assert::noError(function () use ($parser, $html) {
            $matches = $parser->parse($html);

            $i = 0;
            foreach ($matches as $match) {
                $i++;
                Assert::type(Match::class, $match);
            }

            Assert::notEqual(0, $i);
        });
    }
}

(new Web2016ParserTest())->run();
