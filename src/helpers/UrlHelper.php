<?php declare(strict_types=1);

namespace DmitriiKoziuk\yii2Base\helpers;

use yii\helpers\Inflector;

class UrlHelper
{
    public static function getSlugFromString(string $string): string
    {
        $string = trim($string);
        $string = Inflector::transliterate($string);
        $string = preg_replace("/[^a-zA-Z0-9\/\s]/","-", $string);
        $string = preg_replace('/\s{1,}/', '-', $string);
        $string = preg_replace('/[-]{2,}/', '-', $string);
        $string = preg_replace('/[\/]{2,}/', '/', $string);
        $string = trim($string, '-');
        return $string;
    }
}