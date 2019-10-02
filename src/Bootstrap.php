<?php declare(strict_types=1);

namespace DmitriiKoziuk\yii2Base;

use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\web\Application as WebApp;

final class Bootstrap implements BootstrapInterface
{
    /**
     * @param Application $app
     */
    public function bootstrap($app)
    {
        $app->setModule(BaseModule::ID, ['class' => BaseModule::class]);

        /**
         * When application in developer mode automatically reload assets when page requested.
         */
        if (YII_ENV_DEV && $app instanceof WebApp) {
            $assetManager = $app->getAssetManager();
            $assetManager->forceCopy = true;
        }
    }
}