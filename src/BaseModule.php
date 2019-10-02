<?php
namespace DmitriiKoziuk\yii2Base;

use yii\base\Application as BaseApp;
use yii\console\Application as ConsoleApp;
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
        $this->_initLocalProperties($app);
        $this->_registerTranslation($app);
        $this->_registerClassesToDIContainer();
    }

    private function _initLocalProperties(BaseApp $app)
    {
        if ($app instanceof ConsoleApp) {
            $app->controllerMap['migrate']['class'] = 'yii\console\controllers\MigrateController';
        }
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
        $diContainer = \Yii::$container;
        $diContainer->setSingleton(UrlHelper::class, function () {
            return new UrlHelper();
        });
        $diContainer->setSingleton(FileHelper::class, function () {
            return new FileHelper();
        });
    }
}