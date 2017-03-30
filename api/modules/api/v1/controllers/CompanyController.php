<?php

namespace api\modules\api\v1\controllers;

use api\modules\api\v1\resources\ReportResource;

class CompanyController extends BaseController
{
    /**
     * @var string
     */
    public $modelClass = 'api\modules\api\v1\models\Company';

    public function actionReport($date)
    {
        return ReportResource::find()->findAb($date);
    }
}
