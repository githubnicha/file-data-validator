<?php

declare(strict_types=1);

namespace Chasj\FileDataValidator\Service;

class FileReader
{
    public function read($file) {
        $spreadsheet = $this->createSpreadsheet($file);
        $worksheet = $spreadsheet->getActiveSheet();
        $highestRow = $worksheet->getHighestRow();
        for ($row = 0; $row <= $highestRow; ++$row) {
            $worksheet->getCell('A'.$row)->getValue();
        }
    }    
}
