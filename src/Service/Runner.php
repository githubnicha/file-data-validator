<?php

declare(strict_types=1);

namespace Chasj\FileDataValidator\Service;

use Chasj\FileDataValidator\Service\DirectorFile;
use Chasj\FileDataValidator\Service\Parser;

class Runner
{
    public function valid ()
    {
        $dir = new DirectoryFile();
        foreach($dir->dataFiles as $file) {
            $f = $dir->getFile($file);
            $jsonFile = $dir->getJsonFile($file);
            if ($jsonFile === false) {
                continue;
            }
            $parse = new Parser($jsonFile);
            $fr = new FileReader($dir->file);
            $fr->start($f, $parse->parse());
        }
        
        return true;
    }
    
}
