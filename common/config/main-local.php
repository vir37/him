<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=terainvest_him',
            'username' => 'him',
            'password' => 'HimiK',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            //'useFileTransport' => true,

            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 's13.webhost1.ru',
                'username' => 'admin@himsale.ru',
                'password' => '1cf51ca0',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
    ],
];
