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
            'simple string'  => ['Hello, World', 'Hello-World'],
            'typical string' => [
                'Apple iPhone XS Max 64Gb Space Gray (MT502)',
                'Apple-iPhone-XS-Max-64Gb-Space-Gray-MT502'
            ],
            'hard string' => [
                "  Apple !@#$%^&*() \r . iPhone XS---Max \"64Gb\" Space Gray (MT502)  \n\t",
                'Apple-iPhone-XS-Max-64Gb-Space-Gray-MT502'
            ],
            'With slash' => [
                'Apple/iPhone XS Max 64Gb Space Gray (MT502)',
                'Apple-iPhone-XS-Max-64Gb-Space-Gray-MT502'
            ],
        ];
    }
}