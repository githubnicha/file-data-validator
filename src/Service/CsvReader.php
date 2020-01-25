<?php

declare(strict_types=1);

namespace Chasj\FileDataValidator\Service;

class CSVReader extends DataValidator
{
    protected function read($file)
    {
        if (($handle = fopen($file, 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                
            }
            fclose($handle);
        }
    }
}
