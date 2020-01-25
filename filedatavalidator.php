<?php

require_once __DIR__ . '/vendor/autoload.php';

use Chasj\FileDataValidator\Service\Runner;

$runner = new Runner();
$runner->valid();