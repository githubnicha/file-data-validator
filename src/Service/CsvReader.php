<?php

declare(strict_types=1);

namespace Chasj\FileDataValidator\Service;

class CSVReader extends DataValidator implements FileReaderInterface
{
    public function read(string $file, array $attrs)
    {
        if (($handle = fopen($file, 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                $d = array_combine(array_keys($attrs), $data);
                $this->validate($attrs, $d);
            }
            fclose($handle);
        }
    }
}
