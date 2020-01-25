<?php

declare(strict_types=1);

namespace Chasj\FileDataValidator\Service;

use Exception;

class DataValidator
{
    protected $attrs;

    public function __construct($attrs)
    {
        $this->attrs = $attrs;
    }

    public function validate($data)
    {
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
        if (is_string($string)) { 
            throw new Exception($string . ' value is expected to be string');
        }

        return true;
    }

    protected function isNumber(int $number)
    {
        if (is_numeric($string)) { 
            throw new Exception($number . ' value is expected to be number');
        }

        return true;
    }

    protected function isRequired($required)
    {
        if (is_empty($required) || is_null($required)) { 
            throw new Exception($required . ' cannot be empty or null');
        }

        return true;
    }

    protected function isMatch() : bool
    {
        if (is_empty($required) || is_null($required)) { 
            throw new Exception($required . ' cannot be empty or null');
        }

        return true;
    }

    protected function isIncluded($data) : bool
    {
        if (!in_array($data, $this->attrs->enum)) { 
            throw new Exception($data . ' wrong value given');
        }

        return true;
    }
}
