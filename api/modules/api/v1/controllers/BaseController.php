<?php

namespace api\modules\api\v1\controllers;

use Yii;
use yii\filters\Cors;
use yii\web\Response;
use yii\rest\ActiveController;
use yii\filters\VerbFilter;
use yii\filters\ContentNegotiator;

class BaseController extends ActiveController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'corsFilter' => [
                'class' => Cors::className(),
                'cors'  => [
                    'Origin' => ['*'],
                    'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'DELETE', 'HEAD', 'OPTIONS'],
                    'Access-Control-Request-Headers' => ['*'],
                    'Access-Control-Allow-Credentials' => null,
                    'Access-Control-Max-Age' => 86400,
                    'Access-Control-Expose-Headers' => [
                        'X-Pagination-Current-Page',
                        'X-Pagination-Page-Count',
                        'X-Pagination-Per-Page',
                        'X-Pagination-Total-Count'
                    ],
                ]
            ],
            'contentNegotiator' => [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                    'application/xml' => Response::FORMAT_XML,
                ],
            ],
            'verbFilter' => [
                'class' => VerbFilter::className(),
                'actions' => $this->verbs(),
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function runAction($id, $params = [])
    {
        try {
            $result = parent::runAction($id, $params);
        } catch (\yii\web\HttpException $e) {
            if ($e->getCode() > 0) {
                throw $e;
            }
            $excClass  = get_class($e);
            $exception = ($excClass == 'yii\web\HttpException')
                ? new $excClass($e->statusCode, $e->getMessage(), $e->statusCode)
                : new $excClass($e->getMessage(), $e->statusCode)
                ;
            throw $exception;
        }

        return $result;
    }
}
