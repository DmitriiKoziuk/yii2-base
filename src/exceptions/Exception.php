<?php declare(strict_types=1);

namespace DmitriiKoziuk\yii2Base\exceptions;

class Exception extends \Exception
{
    protected $_errors = [];

    public function addErrors(array $errors)
    {
        $this->_errors = array_merge($this->_errors, $errors);
    }

    public function getErrors(): array
    {
        return $this->_errors;
    }

    public function __toString()
    {
        return parent::__toString() . PHP_EOL .
            'Additional Information:' . PHP_EOL .
            print_r($this->_errors, true);
    }
}