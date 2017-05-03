<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'ru-RU',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
	    'authManager' => [
	        'class' => 'yii\rbac\DbManager',
	    ],

    ],
    'aliases' => [
        '@images' => '@frontend/web/images',
        '@icons' => '@frontend/web/icons'
    ],
];
