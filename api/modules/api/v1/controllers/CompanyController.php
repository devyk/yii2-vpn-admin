<?php

namespace api\modules\api\v1\controllers;

use yii\base\Exception;
use yii\base\Module;
use yii\web\BadRequestHttpException;
use api\modules\api\v1\models\Log;
use api\modules\api\v1\models\User;
use api\modules\api\v1\resources\ReportResource;
use api\modules\api\v1\services\Company;
use api\modules\api\v1\services\CompanyInterface;

class CompanyController extends BaseController
{
    /**
     * @var string
     */
    public $modelClass = 'api\modules\api\v1\models\Company';

    /** @var  Company */
    protected $companyService;

    public function __construct($id, Module $module, CompanyInterface $companyService, array $config = [])
    {
        $this->companyService = $companyService;
        parent::__construct($id, $module, $config);
    }

    public function actionReport($date)
    {
        try {
            return $this->companyService->getAbusers(ReportResource::find(), new \DateTime($date));
        } catch(Exception $e) {
            throw new BadRequestHttpException('Failed to fetch abusers list for unknown reason.');
        }
    }

    public function actionGenerate()
    {
        try {
            $this->companyService->generateLogs(User::find(), Log::find(), \Faker\Factory::create());
            \Yii::$app->getResponse()->setStatusCode(201);
        } catch(Exception $e) {
            throw new BadRequestHttpException('Failed to create fake logs for unknown reason.');
        }
    }
}
