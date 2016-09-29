<?php
declare(strict_types = 1);

namespace RadekDvorak\PamaCal\Loader;

require __DIR__ . '/../../../../vendor/autoload.php';

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use RadekDvorak\PamaCal\TestCase;
use Tester\Assert;

class SimpleLoaderTest extends TestCase
{

    public function testLoad()
    {
        $this->setupFilesystem();
        $loader = new SimpleLoader();

        $value = $loader->loadSource(vfsStream::url('testDir/schedule.html'));

        Assert::same('Foo', $value);
    }

    /**
     * @throws \RadekDvorak\PamaCal\Exception\IOException
     */
    public function testLoadFailed()
    {
        $root = $this->setupFilesystem();
        $root->getChild('schedule.html')->chmod(0111);

        $loader = new SimpleLoader();

        $loader->loadSource(vfsStream::url('testDir/schedule.html'));
    }

    /**
     * @return vfsStreamDirectory
     */
    private function setupFilesystem() : vfsStreamDirectory
    {
        $root = vfsStream::setup('testDir');
        $root->addChild(vfsStream::newFile('schedule.html')->withContent('Foo'));

        return $root;
    }
}

(new SimpleLoaderTest())->run();
