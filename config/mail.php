<?php

return [
    'class' => 'yii\swiftmailer\Mailer',
    'enableSwiftMailerLogging' => true,
    'messageConfig' => [
        'from' => ['xxxx' => 'LCM'],
    ],
    'useFileTransport' => false,
    'transport' => [
        'class' => 'Swift_SmtpTransport',
        'host' => 'xxxx',
        'username' => 'xxxx',
        'password' => 'xxxx',
        'port' => '587',
        'encryption' => 'tls',
        'streamOptions' => [
            'ssl' => [
                'allow_self_signed' => true,
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
        ]
    ],
];