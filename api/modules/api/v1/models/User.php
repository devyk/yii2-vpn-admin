<?php

namespace api\modules\api\v1\models;

use api\modules\api\v1\repositories\UserRepository;
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
     * @return UserRepository
     */
    public static function find()
    {
        return new UserRepository(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'company_id'], 'required'],
            [['name', 'email'], 'trim'],
            ['name', 'string', 'length' => [3, 255]],
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
