<?php declare(strict_types=1);

namespace DmitriiKoziuk\yii2Base\traits;

use yii\base\Model;
use DmitriiKoziuk\yii2Base\exceptions\DataNotValidException;

trait ModelValidatorTrait
{
    /**
     * @param Model[] $models
     * @param DataNotValidException $preferException
     * @throws DataNotValidException
     */
    protected function validateModels(array $models, DataNotValidException $preferException = null): void
    {
        $preferException = $preferException ?? new DataNotValidException('Model(s) not valid.');
        foreach ($models as $model) {
            if (! $model->validate()) {
                $modelClassName = get_class($model);
                $preferException->addErrors([$modelClassName => $model->getErrors()]);
            }
        }
        if (! empty($preferException->getErrors())) {
            throw $preferException;
        }
    }
}