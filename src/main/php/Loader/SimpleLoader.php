<?php
declare(strict_types = 1);

namespace RadekDvorak\PamaCal\Loader;

use RadekDvorak\PamaCal\Exception\IOException;

class SimpleLoader implements LoaderInterface
{

    /**
     * @inheritdoc
     */
    public function loadSource(string $url) : string
    {
        $contents = file_get_contents($url);

        if ($contents === false) {
            throw new IOException(sprintf('Unable to open "%s".', $url));
        }

        return $contents;
    }
}
