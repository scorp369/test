<?php

return [
    'id'        => 'basic',
    'basePath'  => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases'   => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules'   => [
        'user' => ['class' => 'app\modules\user\UserModule',],
        'news' => ['class' => 'app\modules\news\NewsModule',],
    ],
];
