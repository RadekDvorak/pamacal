<?php
declare(strict_types = 1);

namespace RadekDvorak\PamaCal\Parser;

require __DIR__ . '/../../../../vendor/autoload.php';

use RadekDvorak\PamaCal\Match;
use RadekDvorak\PamaCal\TestCase;
use Tester\Assert;

class Web2016ParserTest extends TestCase
{

    /**
     * @dataProvider provideHtmlSources
     * @param string $html
     */
    public function testParse(string $html)
    {
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

    public function provideHtmlSources() : \Iterator
    {
        $files = [
            __DIR__ . '/schedule-2016-1.html',
            __DIR__ . '/schedule-2016-2.html',
            __DIR__ . '/schedule-2016-3.html',
        ];

        foreach ($files as $file) {
            yield file_get_contents($file);
        }
    }
}

(new Web2016ParserTest())->run();
