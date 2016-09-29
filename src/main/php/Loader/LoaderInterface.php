<?php
declare(strict_types = 1);

namespace RadekDvorak\PamaCal\Loader;

interface LoaderInterface
{

    /**
     * @param string $url
     * @return string
     */
    public function loadSource(string $url) : string;
}
