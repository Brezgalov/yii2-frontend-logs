<?php

namespace Brezgalov\FrontendLogs;

use yii\base\Action;
use yii\base\InvalidConfigException;
use yii\web\ServerErrorHttpException;

class FrontendLogsAction extends Action
{
    /**
     * @var ILoggerStorage
     */
    public $logStorage;

    /**
     * @return FrontendLogDto|bool[]
     * @throws InvalidConfigException
     * @throws ServerErrorHttpException
     */
    public function run()
    {
        $logStorage = $this->logStorage;

        if (is_array($logStorage) || is_string($logStorage)) {
            $logStorage = \Yii::createObject($logStorage);
        }

        if (!($logStorage instanceof ILoggerStorage)) {
            throw new InvalidConfigException('logStorage is invalid');
        }

        $dto = new FrontendLogDto();
        $dto->load(\Yii::$app->request->getBodyParams(), '');

        if (empty($dto->action)) {
            $dto->addError('action', 'set action plz');
            return $dto;
        }

        $id = $logStorage->storeLog($dto);
        if (!$id) {
            throw new ServerErrorHttpException('Can not save log');
        }

        return ['success' => true];
    }
}