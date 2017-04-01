<?php

namespace api\modules\api\v1\models;

use api\modules\api\v1\repositories\CompanyRepository;
use yii\db\ActiveRecord;

class Company extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%companies}}';
    }

    /**
     * @return CompanyRepository
     */
    public static function find()
    {
        return new CompanyRepository(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'string', 'length' => [3, 255]],
            ['quota', 'integer']
        ];
    }

    public function getUsers()
    {
        return $this->hasMany(User::className(), ['company_id' => 'id']);
    }

    public function getLogs()
    {
        return $this->getUsers()->joinWith('logs');
    }
}
