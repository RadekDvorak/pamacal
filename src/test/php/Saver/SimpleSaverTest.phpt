<?php
declare(strict_types = 1);

namespace RadekDvorak\PamaCal\Saver;

require __DIR__ . '/../../../../vendor/autoload.php';

use org\bovigo\vfs\vfsStream;
use RadekDvorak\PamaCal\TestCase;
use Tester\Assert;

class SimpleSaverTest extends TestCase
{

    public function testSave()
    {
        $root = vfsStream::setup('testDir');
        $saver = new SimpleSaver();

        $saver->save('This is a calendar', vfsStream::url('testDir/calendar.ics'));

        Assert::true($root->hasChild('calendar.ics'));
        Assert::same('This is a calendar', file_get_contents($root->getChild('calendar.ics')->url()));
    }

    /**
     * @throws \RadekDvorak\PamaCal\Exception\IOException
     */
    public function testSaveFailed()
    {
        $root = vfsStream::setup('testDir');
        $root->chmod(0111);

        $saver = new SimpleSaver();

        $saver->save('This is a calendar', vfsStream::url('testDir/calendar.ics'));
    }
}

(new SimpleSaverTest())->run();
