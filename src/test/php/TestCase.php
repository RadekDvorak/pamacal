<?php
declare(strict_types = 1);

namespace RadekDvorak\PamaCal;

class TestCase extends \Tester\TestCase
{

    protected function tearDown()
    {
        \Mockery::close();
    }
}
