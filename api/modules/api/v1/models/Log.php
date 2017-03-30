<?php

namespace api\modules\api\v1\models;

use api\modules\api\v1\repositories\LogRepository;
use yii\db\ActiveRecord;

class Log extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%logs}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'transfer_total'], 'integer'],
            ['date', 'string'],
            ['resource', 'string'],
        ];
    }
}
