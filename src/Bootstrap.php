<?php declare(strict_types=1);

namespace DmitriiKoziuk\yii2Base;

use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\InvalidConfigException;
use yii\di\NotInstantiableException;
use yii\web\Application as WebApp;
use DmitriiKoziuk\yii2ModuleManager\services\ModuleRegistrationService;

final class Bootstrap implements BootstrapInterface
{
    /**
     * @param Application $app
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     */
    public function bootstrap($app)
    {
        ModuleRegistrationService::addModule(BaseModule::class, function () use ($app) {
            return [
                'class' => BaseModule::class,
                'diContainer' => \Yii::$container,
            ];
        });

        /**
         * When application in developer mode automatically reload assets when page requested.
         */
        if (YII_ENV_DEV && $app instanceof WebApp) {
            $assetManager = $app->getAssetManager();
            $assetManager->forceCopy = true;
        }
    }
}