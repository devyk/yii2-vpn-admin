<?php

namespace api\modules\api\v1\resources;

use api\modules\api\v1\models\Company;

class ReportResource extends Company
{
    /**
     * @var int $total
     */
    public $total;

    public function fields()
    {
        return [
            'id',
            'name',
            'quota',
            'total' => function () {
                return (int) $this->total;
            }
        ];
    }
}