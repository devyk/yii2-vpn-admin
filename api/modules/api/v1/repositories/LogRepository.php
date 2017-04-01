<?php

namespace api\modules\api\v1\repositories;

use yii\db\ActiveQuery;
use api\modules\api\v1\models\Log;

class LogRepository extends ActiveQuery
{
    /**
     * @param array $data
     * @return int
     */
    public function insertBatch(array $data)
    {
        return $this->createCommand()->batchInsert(
            Log::tableName(),
            ['user_id', 'date', 'resource', 'transfer_total'],
            $data
        )->execute();
    }
}
