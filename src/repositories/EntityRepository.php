<?php
namespace DmitriiKoziuk\yii2Base\repositories;

use yii\db\ActiveRecord;
use DmitriiKoziuk\yii2Base\exceptions\EntityNotValidException;
use DmitriiKoziuk\yii2Base\exceptions\EntitySaveException;
use DmitriiKoziuk\yii2Base\exceptions\EntityDeleteException;

class EntityRepository
{
    /**
     * @param ActiveRecord $record
     * @throws \DmitriiKoziuk\yii2Base\exceptions\EntityNotValidException
     * @throws \DmitriiKoziuk\yii2Base\exceptions\EntitySaveException
     */
    public function save(ActiveRecord $record): void
    {
        $className = get_class($record);
        if (! $record->validate()) {
            $exception = new EntityNotValidException("Record '{$className}' not valid.");
            $exception->addErrors($record->getErrors());
            throw $exception;
        }
        if (! $record->save()) {
            throw new EntitySaveException("Can't save entity '{$className}'");
        }
    }

    /**
     * @param ActiveRecord $record
     * @throws EntityDeleteException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function delete(ActiveRecord $record): void
    {
        if (false === $record->delete()) {
            $class = get_class($record);
            throw new EntityDeleteException("Can't delete entity '{$class}'");
        }
    }
}