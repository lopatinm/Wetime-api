<?php
$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'v1' => [
            'class' => 'app\modules\v1\Module',
        ],
    ],
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'request' => [
            'cookieValidationKey' => 'Ex01Ga0qeGfFn_htk2FD8O7mDlI6gD1P',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'response' => [
            'on beforeSend' => function (yii\base\Event $event) {
                $response = $event->sender;
                if ((500 === $response->statusCode || 404 === $response->statusCode || 401 === $response->statusCode || 403 === $response->statusCode) && is_array($response->data)) {
                    if($response->data['code'] == 485){
                        $response->data['name'] = "Already exist";
                    }
                    $response->data['code'] = $response->data['status'];
                    $response->data['status'] = 'Error';
                    unset($response->data['type']);
                }
            },
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\modules\v1\models\User',
            'enableAutoLogin' => false,
            'loginUrl' => null,
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'pluralize' => false,
                    'controller' => [
                        'v1/user',
                        'v1/organization',
                        'v1/event',
                        'v1/category',
                        'v1/country',
                        'v1/region',
                        'v1/district',
                        'v1/locality',
                        'v1/post',
                        'v1/subscription',
                        'v1/request'
                    ],
                    'extraPatterns' => [
                        'POST login' => 'login',
                        'OPTIONS login' => 'options',
                        'POST registration' => 'registration',
                        'OPTIONS registration' => 'options',
                        'POST access' => 'access',
                        'OPTIONS access' => 'options'
                    ],
                ],
            ],
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
