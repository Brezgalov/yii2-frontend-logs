<?php

namespace Brezgalov\FrontendLogs;

use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\db\Connection;

class Yii2MysqlLoggerStorage extends Component implements ILoggerStorage
{
    /**
     * @var Connection
     */
    public $db;

    /**
     * @var string
     */
    public $primary = 'id';

    /**
     * @var string
     */
    public $table = 'frontend_logs';

    /**
     * @return Connection|null
     * @throws InvalidConfigException
     */
    public function getDb()
    {
        if (is_string($this->db) || is_array($this->db)) {
            return \Yii::createObject($this->db);
        }

        if ($this->db instanceof Connection) {
            return $this->db;
        }

        return null;
    }

    /**
     * @param Model $dto
     * @return array|false|int|mixed|string|null
     * @throws InvalidConfigException
     * @throws \yii\base\NotSupportedException
     */
    public function storeLog(Model $dto)
    {
        $db = $this->getDb();

        if (!($db instanceof Connection)) {
            throw new InvalidConfigException('db should be set as ' . Connection::class);
        }

        $res = $db->getSchema()->insert($this->table, $dto->toArray());

        return $res ? $res[$this->primary] : $res;
    }
}