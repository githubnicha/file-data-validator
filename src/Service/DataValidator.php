<?php

declare(strict_types=1);

namespace Chasj\FileDataValidator\Service;

use Exception;

class DataValidator
{

    protected $attrs;

    public function validate(array $attrs, array $data)
    {
        foreach ($data as $k => $v) {
            $this->attrs = $attrs[$k];
            switch ($attrs[$k]['type']) {
                case 'date':
                    $this->isDate($v);
                    break;
                case 'number':
                case 'integer':
                    $this->isNumber($v);
                    break;
                case 'float':
                case 'double':
                    $this->isFloat($v);
                    break;
                default:
                    $this->isString($v);
            }
            if (isset($attrs[$k]['required']) && $attrs[$k]['required'] === true) {
                $this->isRequired($v);
            }
            if (isset($attrs[$k]['enum']) && count($attrs[$k]['enum'])) {
                $this->isIncluded($v);
            }
        }
        return true;
    }

    protected function isDate(string $date, string $format = 'Y-m-d') : bool
    {
        $d = DateTime::createFromFormat($format, $date);
        if (!($d && $d->format($format) === $date)) { 
            throw new Exception($date . ' value is not a valid date');
        }

        return true;
    }

    protected function isString(string $string) : bool
    {
        if (!is_string($string)) { 
            throw new Exception($string . ' value is expected to be a string');
        }

        return true;
    }

    protected function isNumber($number)
    {
        if (!is_numeric($number)) {
            throw new Exception($number . ' value is expected to be a number');
        }

        return true;
    }

    protected function isFloat($float)
    {
        if (!is_float($float)) { 
            throw new Exception($float . ' value is expected to be a decimal number');
        }

        return true;
    }

    protected function isRequired($required)
    {
        if (empty($required) || is_null($required)) { 
            throw new Exception($required . ' cannot be empty or null');
        }

        return true;
    }

    protected function isMatch() : bool
    {
        return true;
    }

    protected function isIncluded($data) : bool
    {
        if (!in_array($data, $this->attrs['enum'])) { 
            throw new Exception($data . ' wrong value given');
        }

        return true;
    }
}
