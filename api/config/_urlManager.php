<?php
// Api url rules
return [
    'class' => 'yii\web\UrlManager',
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => 'api/v1/user',
        ],
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => 'api/v1/company',
            'extraPatterns' => [
                'GET report/<date>' => 'report',
            ],
        ]
    ]
];