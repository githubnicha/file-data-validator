<?php

declare(strict_types=1);

namespace Chasj\FileDataValidator\Service;
use \Maatwebsite\Excel\Facades\Excel;

class ExcelReader extends DataValidator implements FileReaderInterface
{
    public function read(string $file, array $attrs) {
        // $spreadsheet = $this->createSpreadsheet($file);
        // $worksheet = $spreadsheet->getActiveSheet();
        // $highestRow = $worksheet->getHighestRow();
        // for ($row = 0; $row <= $highestRow; ++$row) {

        // }
    }    
}
