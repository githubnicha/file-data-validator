<?php

declare(strict_types=1);

namespace Chasj\FileDataValidator\Service;

use Exception;

class FileValidator
{
    protected function isExist($file)
    {
        if (!file_exists($file)) {
            throw new Exception('File does not exist');
        }
    }

    protected function isValidFileType ($file, $type)
    {
        $fileInfo = pathinfo($file);
        if (!in_array($fileInfo['extension'], $type)) {
            throw new Exception('Invalid file type');
        }
    }
    
}
