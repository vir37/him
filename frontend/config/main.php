<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'suffix' => '.html',
            'rules' => [
                [
                    'pattern' => 'sitemap.xml',
                    'route' => 'sitemap/index',
                    'suffix' => '',
                ],
                [
                    'pattern' => '<city:[\w-]+>',
                    'route' => 'site/index',
                    'suffix' => '/',
                    'normalizer' => false,
                ],
                [
                    'pattern' => '<city:[\w-]+>/<controller:[\w-]+>',
                    'route' => '<controller>/index',
                    'suffix' => '/',
                ],
                '<city:[\w-]+>/<controller:[\w-]+>/<action:[\w-]+>/<parent_id:\d+>/<id:\d+>' => '<controller>/<action>',
                '<city:[\w-]+>/<controller:[\w-]+>/<id:\d+>' => '<controller>/view',
                '<city:[\w-]+>/<controller:[\w-]+>/<action:[\w-]+>/<id:\d+>' => '<controller>/<action>',
                '<city:[\w-]+>/<controller:[\w-]+>/<action:[\w-]+>' => '<controller>/<action>',
                [ // Редиректное правило для переброски на дефолтный город
                    'class' => 'frontend\components\RedirectUrlRule',
                    'pattern' => '',
                    'route' => 'kzn/',
                    'suffix' => '/',
                ],
            ],
        ],
    ],
    'params' => $params,
];
