<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name'=>'LCM',

    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
    ],
    'components' => [
        'ad' => [
            'class' => 'Edvlerblog\Adldap2\Adldap2Wrapper',

            'providers' => [
                'default' => [
                    // Connect this provider on initialisation of the LdapWrapper Class automatically
                    'autoconnect' => true,

                    'config' => [
                        'account_suffix'        => 'xxx',
                        'domain_controllers'    => ['xxxx'],
                        'base_dn'               => 'xxx',
                        'admin_username'        => 'xxx',
                        'admin_password'        => 'xxx',
]
                ],
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'IVbU4zgkj0leiyFTGxelITwcu2GxbxUr',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\components\UserLdap',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'enableSwiftMailerLogging' => true,
            'messageConfig' => [
                'from' => ['xxx' => 'LCM'],
            ],
            'useFileTransport' => true,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'xxxx',
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

        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'db' => 'db',
                    'sourceMessageTable'=>'{{%source_message}}',
                    'messageTable'=>'{{%message}}',
                    'enableCaching' => true,
                    'cachingDuration' => 10,
                    'forceTranslation'=>true,
                ],
            ],
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'admin' => 'admin/default',
                '<controller:(attach)>/<action:\w+>/<key:\w+>' => '<controller>/<action>',
                '<controller:(attach)>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:(attach)>/<action:\w+>' => '<controller>/<action>',
                '<controller:(attach)>/' => '<controller>/index',
                '<action:\w+>/<id:\d+>' => 'site/<action>',
                '<action:\w+>' => 'site/<action>',

            ],
        ],
        'formatter' => [
            'dateFormat' => 'dd.MM.yyyy HH:i',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            //'currencyCode' => 'EUR',
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
