<?php declare(strict_types=1);

namespace DmitriiKoziuk\yii2Base\interfaces;

use yii\db\ActiveRecord;
use DmitriiKoziuk\yii2Base\exceptions\EntityNotValidException;
use DmitriiKoziuk\yii2Base\exceptions\EntitySaveException;

interface ActiveRecordRepositoryInterface
{
    /**
     * @param ActiveRecord $activeRecord
     * @throws EntityNotValidException
     * @throws EntitySaveException
     * @return ActiveRecord saved active record
     */
    public function save(ActiveRecord $activeRecord): ActiveRecord;

    public function delete(ActiveRecord $activeRecord): void;
}