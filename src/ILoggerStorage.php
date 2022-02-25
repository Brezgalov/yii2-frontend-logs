<?php

namespace Brezgalov\FrontendLogs;

use yii\base\Model;

interface ILoggerStorage
{
    /**
     * @param Model $dto
     * @return int|string
     */
    public function storeLog(Model $dto);
}