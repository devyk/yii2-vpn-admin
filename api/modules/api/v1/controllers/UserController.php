<?php

namespace api\modules\api\v1\controllers;

class UserController extends BaseController
{
    /**
     * @var string
     */
    public $modelClass = 'api\modules\api\v1\models\User';

    public function actions()
    {
        $actions = parent::actions();
        $actions['request'] = [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ];
        return $actions;
    }
}
