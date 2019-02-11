<?php
namespace DmitriiKoziuk\yii2Base\services;

use yii\db\Connection;
use yii\db\Transaction;
use yii\db\Exception;
use DmitriiKoziuk\yii2Base\exceptions\ExternalComponentException;

class DBActionService
{
    /**
     * @var Connection|null
     */
    protected $_db;

    /**
     * @var Transaction|null
     */
    protected $_transaction;

    public function __construct(Connection $db = null)
    {
        /**
         * Check is transaction already begin. I dont need one more transaction.
         */
        if (! empty($db) && empty($db->getTransaction())) {
            $this->_db = $db;
        }
    }

    /**
     * Begin transaction if has Connection, and if no one start transaction early.
     * If transaction already running, it`s mean, that service is a part of much bigger of business logic and
     * one more transaction can break it.
     */
    protected function beginTransaction(): void
    {
        if (! empty($this->_db) && empty($this->_db->getTransaction())) {
            $this->_transaction = $this->_db->beginTransaction();
        }
    }

    /**
     * @throws ExternalComponentException
     */
    protected function commitTransaction(): void
    {
        try {
            if (! empty($this->_transaction)) {
                $this->_transaction->commit();
            }
        } catch (Exception $e) {
            throw new ExternalComponentException('Some problem with data base.');
        }
    }

    /**
     * @throws ExternalComponentException
     */
    protected function rollbackTransaction(): void
    {
        try {
            if (! empty($this->_transaction)) {
                $this->_transaction->rollBack();
            }
        } catch (Exception $e) {
            throw new ExternalComponentException('Some problem with data base.');
        }
    }
}