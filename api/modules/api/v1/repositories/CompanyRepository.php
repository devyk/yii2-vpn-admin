<?php

namespace api\modules\api\v1\repositories;

use yii\db\ActiveQuery;

class CompanyRepository extends ActiveQuery
{
    public function findAbusers(\DateTime $date)
    {
        return $this->select([
            'companies.*',
            'SUM(logs.transfer_total) AS total',
        ])
        ->joinWith('users')
        ->joinWith('logs')
        ->where([
            'between',
            'logs.date',
            $date->format('Y-m-d'),
            $date->format('Y-m-t')
        ])
        ->groupBy('companies.id')
        ->having([
            '>',
            'total',
            'companies.quota'
        ])
        ->orderBy(['companies.quota' => SORT_DESC])
        ->all();
    }
}
