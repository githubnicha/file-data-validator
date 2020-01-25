<?php

declare(strict_types=1);

namespace Chasj\FileDataValidator\Service;

use Exception;

class Parser extends FileValidator
{
    protected $file;
    private $fileType = 'json';
    public $attrs;

    public function __construct(string $file)
    {
        $this->file = $file;
    }

    public function parse()
    {
        $this->isExist($this->file);
        $this->isValidFileType($this->file, [$this->fileType]);

        return  $this->isValidJson($this->isEmpty());
    }

    protected function isEmpty()
    {
        $string = file_get_contents($this->file);
        if (empty($string)) {
            throw new Exception('Empty data');
        }

        return $string;
    }

    protected function isValidJson($string)
    {
        $json = json_decode($string, true);
        if (empty($json) || is_null($json)) {
            throw new Exception('Invalid JSON format');
        }
        $this->attrs = $json;
        
        return $json;
    }
}
