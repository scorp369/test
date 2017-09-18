<?php

$params = require __DIR__ . '/params.php';
$db     = require __DIR__ . '/db.php';

$config = \yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/common.php'),
    [
        'components'     => [
            'view'         => [
                'class' => 'app\components\mvc\view\View',
            ],
            'request'      => [
                'cookieValidationKey' => 'any cookie validation key',
            ],
            'cache'        => [
                'class' => 'yii\caching\FileCache',
            ],
            'user'         => [
                'identityClass'   => 'app\modules\user\models\User',
                'enableAutoLogin' => true,
                'loginUrl'        => ['/login'],
            ],
            'errorHandler' => [
                'errorAction' => 'site/error',
            ],
            'mailer'       => [
                'class'            => 'yii\swiftmailer\Mailer',
                'useFileTransport' => false,
                'transport'        => [
                    'class'      => 'Swift_SmtpTransport',
                    'host'       => 'smtp.yandex.ru',
                    'username'   => getenv('YANDEX_LOGIN'),
                    'password'   => getenv('YANDEX_PASSWORD'),
                    'port'       => '465',
                    'encryption' => 'ssl',
                ]
            ],
            'log'          => [
                'traceLevel' => YII_DEBUG ? 3 : 0,
                'targets'    => [
                    [
                        'class'  => 'yii\log\FileTarget',
                        'levels' => ['error', 'warning'],
                    ],
                ],
            ],
            'db'           => $db,
            'urlManager'   => [
                'enablePrettyUrl' => true,
                'showScriptName'  => false,
            ],
            'authManager'  => [
                'class'        => 'yii\rbac\PhpManager',
                'defaultRoles' => ['admin', 'manager', 'user'],
            ],
        ],
        'as initializer' => [
            'class' => '\app\components\ApplicationInitializerBehavior'
        ],
        'params'         => $params,
        'sourceLanguage' => 'en-US',
        'language'       => 'ru-RU',
        'timeZone'       => 'Europe/Moscow',
    ]);

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][]      = 'debug';
    $config['modules']['debug'] = [
        'class'      => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '10.1.1.100'],
    ];

    $config['bootstrap'][]    = 'gii';
    $config['modules']['gii'] = [
        'class'      => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '10.1.1.100'],
    ];
}

return $config;
