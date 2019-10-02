<?php declare(strict_types=1);

namespace DmitriiKoziuk\yii2Base\forms;

use yii\base\Model;

class Form extends Model
{
    public function getErrorsAsString(): string
    {
        $string = '';
        foreach ($this->getErrors() as $errorName => $messages) {
            $string .= $errorName . PHP_EOL;
            foreach ($messages as $message) {
                $string .= '-' . $message . PHP_EOL;
            }
        }
        return $string;
    }
}