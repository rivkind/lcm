<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'ad' => [
            'class' => 'Edvlerblog\Adldap2\Adldap2Wrapper',

            'providers' => [
                'default' => [ //Providername default
                    // Connect this provider on initialisation of the LdapWrapper Class automatically
                    'autoconnect' => true,

                    'config' => [
                        // Your account suffix, for example: matthias.maderer@example.lan
                        'account_suffix'        => '@life.com.by',

                        // You can use the host name or the IP address of your controllers.
                        'domain_controllers'    => ['srv-dc-01.best.local'],

                        // Your base DN. This is usually your account suffix.
                        'base_dn'               => 'DC=best,DC=local',

                        // The account to use for querying / modifying users. This
                        // does not need to be an actual admin account.
                        'admin_username'        => 'job-functionList',
                        'admin_password'        => 'swims-sZ4Uj',
                    ]
                ],
            ], // close providers array
        ], //close ad
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,
    'controllerMap' => [
        //...
        'ldapcmd' => [
            'class' => 'Edvlerblog\Adldap2\commands\LdapController',
        ],
        //...
    ],
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
