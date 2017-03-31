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
        $faker = \Faker\Factory::create();
        var_dump($faker->dateTimeBetween('-6 month', 'now')->format('Y-m-d'));
        die;
        return ReportResource::find()->findAb($date);
    }
}
