<?php

namespace api\modules\api\v1\repositories;

use yii\db\ActiveQuery;

class CompanyRepository extends ActiveQuery
{
    public function findAb($date)
    {
        return $this->select([
            'companies.*',
            'SUM(logs.transfer_total) AS total',
        ])->joinWith('users')
            ->joinWith('logs')
            ->where(['logs.date' => $date])
            ->groupBy('companies.id')
            ->having([
                '>',
                'total',
                'companies.quota'
            ])->orderBy('')->all();
    }
}