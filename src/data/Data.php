<?php
namespace DmitriiKoziuk\yii2Base\data;

class Data
{
    public function __get($name)
    {
        return $this->{'get' . $name}();
    }
}