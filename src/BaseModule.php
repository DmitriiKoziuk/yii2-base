<?php
namespace DmitriiKoziuk\yii2Base;

use yii\base\Application as BaseApp;
use DmitriiKoziuk\yii2Base\repositories\EntityRepository;
use DmitriiKoziuk\yii2Base\helpers\UrlHelper;
use DmitriiKoziuk\yii2Base\helpers\FileHelper;

final class BaseModule extends \yii\base\Module
{
    const ID = 'dk-base';

    const TRANSLATE = self::ID;

    /**
     * @var \yii\di\Container
     */
    public $diContainer;

    public function init()
    {
        /** @var BaseApp $app */
        $app = $this->module;
        $this->_registerTranslation($app);
        $this->_registerClassesToDIContainer();
    }

    private function _registerTranslation(BaseApp $app)
    {
        $app->i18n->translations[self::ID] = [
            'class'          => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en',
            'basePath'       => '@DmitriiKoziuk/yii2Base/messages',
        ];
    }

    private function _registerClassesToDIContainer()
    {
        $this->diContainer->setSingleton(EntityRepository::class, function () {
            return new EntityRepository();
        });
        $this->diContainer->setSingleton(UrlHelper::class, function () {
            return new UrlHelper();
        });
        $this->diContainer->setSingleton(FileHelper::class, function () {
            return new FileHelper();
        });
    }
}