<?php

declare(strict_types=1);

namespace Chasj\FileDataValidator\Service;

use Exception;
define("BASE_DIR", realpath(__DIR__."/../.."));

class DirectoryFile extends FileValidator
{
    private $asset = DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR;
    private $data = DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR;
    private $json = DIRECTORY_SEPARATOR . 'json' . DIRECTORY_SEPARATOR;
    private $fileTypes = [
        'files' => ['xls', 'xlxs', 'csv'],
        'json' => ['json']
    ];

    public $dataFiles;

    public function __construct()
    {
        $this->fileDir();
    }

    private function fileDir() 
    {
        $this->dataFiles = array_diff( scandir(BASE_DIR . $this->asset . $this->data), ['.', '..'] );
        if (!count($this->dataFiles)) {
            throw new Exception('No data file to process. Save file to assets/files directory');
        }
        foreach($this->dataFiles as $file) {
            $this->isExist(BASE_DIR . $this->asset . $this->data. $file);
            $this->isValidFileType($file, $this->fileTypes['files']);
        }
    }

    public function getJsonFile($dataFile)
    {
        $fileInfo = pathinfo(BASE_DIR . $this->asset . $this->data . $dataFile);

        return $fileInfo ? BASE_DIR . $this->asset . $this->json . $fileInfo['filename'].'.json' : false; 
    }
}
