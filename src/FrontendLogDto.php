<?php

namespace Brezgalov\FrontendLogs;

use yii\base\Model;
use yii\helpers\Json;

class FrontendLogDto extends Model
{
    /**
     * @var string
     */
    public $action;

    /**
     * @var array
     */
    public $meta = [];

    /**
     * @var string
     */
    protected $created_at;

    /**
     * @return array[]
     */
    public function rules()
    {
        return [
            [['action'], 'required'],
            [['meta'], 'safe'],
        ];
    }

    /**
     * @return string[]
     */
    public function fields()
    {
        return [
            'action',
            'meta' => 'metaJson',
            'created_at' => 'createdAt',
        ];
    }

    /**
     * @return string
     */
    public function getMetaJson()
    {
        return Json::encode($this->meta);
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        if (empty($this->created_at)) {
            $this->created_at = date('Y-m-d H:i:s');
        }

        return $this->created_at;
    }
}