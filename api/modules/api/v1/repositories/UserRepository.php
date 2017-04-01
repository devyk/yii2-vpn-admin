<?php

namespace api\modules\api\v1\repositories;

use yii\db\ActiveQuery;

class UserRepository extends ActiveQuery
{
    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function findAllIds()
    {
        return $this->select('id')->asArray()->all();
    }
}
