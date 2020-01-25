<?php

declare(strict_types=1);

namespace Chasj\FileDataValidator\Service;

define("BASE_DIR", realpath(__DIR__."/../.."));
use Exception;
use Chasj\FileDataValidator\Service\ExcelReader;
use Chasj\FileDataValidator\Service\CsvReader;

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
    public $file;

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
        $json = BASE_DIR . $this->asset . $this->json . $fileInfo['filename'].'.json';
        try {
            $this->isExist(BASE_DIR . $this->asset . $this->json . $fileInfo['filename'].'.json');
        } catch (Exception $e) {
            return false;
        }

        return $json; 
    }

    public function getFile($file) 
    {
        $this->file = BASE_DIR . $this->asset . $this->data . $file;
        $fileInfo = pathinfo($this->file);
        switch ($fileInfo['extension']) {
            case 'csv': 
                return new CsvReader($this->file);
                break;
            default:
                return new ExcelReader($this->file);

        }
    }
}
