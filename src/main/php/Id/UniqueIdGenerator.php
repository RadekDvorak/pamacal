<?php
declare(strict_types = 1);

namespace RadekDvorak\PamaCal\Id;

class UniqueIdGenerator
{

    public function createUniqueId()
    {
        return uniqid();
    }
}
