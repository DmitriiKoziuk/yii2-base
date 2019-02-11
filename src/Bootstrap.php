<?php
namespace DmitriiKoziuk\yii2Base;

use yii\base\BootstrapInterface;
use yii\web\Application as WebApp;

final class Bootstrap implements BootstrapInterface
{
    /**
     * @param \yii\base\Application $app
     */
    public function bootstrap($app)
    {
        $app->bootstrap[] = BaseModule::ID;
        $app->setModule(BaseModule::ID, [
            'class' => BaseModule::class,
            'diContainer' => \Yii::$container,
        ]);

        /**
         * When application in developer mode automatically reload assets when page requested.
         */
        if (YII_ENV_DEV && $app instanceof WebApp) {
            $assetManager = $app->getAssetManager();
            $assetManager->forceCopy = true;
        }
    }
}