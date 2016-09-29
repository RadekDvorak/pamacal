<?php
declare(strict_types = 1);

namespace RadekDvorak\PamaCal;

use Symfony\Component\Console\Application;

require_once __DIR__ . '/../../../vendor/autoload.php';

$application = new Application('PamaCal', '0.3');
$application->add(new CreateCalendarCommand());
$application->run();
