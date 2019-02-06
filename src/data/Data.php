<?php
namespace DmitriiKoziuk\yii2Base\data;

use yii\base\Model;

class Data extends Model
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