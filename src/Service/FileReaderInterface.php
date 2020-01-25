<?php

declare(strict_types=1);

namespace Chasj\FileDataValidator\Service;

interface FileReaderInterface
{
    public function read(string $file, array $attrs);
}
