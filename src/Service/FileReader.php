<?php

declare(strict_types=1);

namespace Chasj\FileDataValidator\Service;

use Chasj\FileDataValidator\Service\FileReaderInterface;

class FileReader
{
    protected $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function start(FileReaderInterface $file, $attr)
    {
        $file->read($this->file, $attr);
    }
}
