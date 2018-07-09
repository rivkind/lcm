<?php

return [
    'class' => 'yii\swiftmailer\Mailer',
    'enableSwiftMailerLogging' => true,
    'messageConfig' => [
        'from' => ['xxx' => 'LCM'],
    ],
    'useFileTransport' => false,
    'transport' => [
        'class' => 'Swift_SmtpTransport',
        'host' => 'xxx',
        'username' => 'xxx',
        'password' => 'xxx',
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