<?php
namespace DmitriiKoziuk\yii2Base\tests\unit\helpers;

use Codeception\Test\Unit;
use DmitriiKoziuk\yii2Base\helpers\UrlHelper;

class UrlHelperTest extends Unit
{
    /**
     * @dataProvider dataProviderSlugFromString
     * @param string $string
     * @param string $expect
     */
    public function testGetSlugFromString(string $string, string $expect): void
    {
        expect('Slug string', UrlHelper::getSlugFromString($string))->equals($expect);
    }

    public function dataProviderSlugFromString(): array
    {
        return [
            'do nothing'     => ['', ''],
            'simple string'  => ['Hello, world', 'hello-world'],
            'typical string' => [
                'Apple iPhone Xs Max 64Gb Space Gray (MT502)',
                'apple-iphone-xs-max-64gb-space-gray-mt502'
            ],
            'hard string' => [
                "  Apple !@#$%^&*() \r . iPhone Xs---Max \"64Gb\" Space Gray (MT502)  \n\t",
                'apple-iphone-xs-max-64gb-space-gray-mt502'
            ],
            'With slash' => [
                'Apple/iPhone Xs Max 64Gb Space Gray (MT502)',
                'apple/iphone-xs-max-64gb-space-gray-mt502'
            ],
        ];
    }
}