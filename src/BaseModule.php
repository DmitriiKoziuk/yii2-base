<?php declare(strict_types=1);

namespace DmitriiKoziuk\yii2Base;

use yii\base\Application as BaseApp;

final class BaseModule extends \yii\base\Module
{
    const ID = 'dk-base';

    const TRANSLATION = self::ID;

    public function init()
    {
        /** @var BaseApp $app */
        $app = $this->module;
        $this->registerTranslation($app);
    }

    private function registerTranslation(BaseApp $app)
    {
        $app->i18n->translations[self::TRANSLATION] = [
            'class'          => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en',
            'basePath'       => '@DmitriiKoziuk/yii2Base/messages',
        ];
    }
}