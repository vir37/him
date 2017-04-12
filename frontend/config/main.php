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
                    'pattern' => '',
                    'suffix' => '/',
                    'route' => '/',
                    'normalizer' => [
                        'class' => 'yii\web\UrlNormalizer',
                        'action' => yii\web\UrlNormalizer::ACTION_REDIRECT_TEMPORARY,
                    ],
                    'defaults' => [ 'city' => 'kzn'],
                ],
                [
                    'pattern' => '<city:>',
                    'route' => 'site/index',
                    'suffix' => '/',
                    'normalizer' => false,
                ],

//                '<city:>/' => 'site/index',
                '<city:[\w-]+>/<controller:>' => '<controller>/index',
                '<city:[\w-]+>/<controller:>/<action:>' => '<controller>/<action>',
            ],
        ],
    ],
    'params' => $params,
];
