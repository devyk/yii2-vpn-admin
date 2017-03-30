<?php

namespace api\modules\api\v1\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'company_id'], 'required'],
            ['name', 'string'],
            ['email', 'email'],
            [
                'company_id',
                'exist',
                'targetClass' => Company::className(),
                'targetAttribute' => 'id'
            ]
        ];
    }

    public function getLogs()
    {
        return $this->hasMany(Log::className(), ['user_id' => 'id']);
    }
}
