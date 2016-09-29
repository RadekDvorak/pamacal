<?php
declare(strict_types = 1);

namespace RadekDvorak\PamaCal\Saver;

use RadekDvorak\PamaCal\Exception\IOException;

class SimpleSaver implements SaverInterface
{

    /**
     * @inheritdoc
     */
    public function save(string $calendar, string $url)
    {
        $status = @file_put_contents($url, $calendar); // intentionally @

        if ($status === false) {
            $error = error_get_last();
            throw new IOException(sprintf('Unable to save calendar to "%s". %s', $url, $error['message']));
        }
    }
}
