<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=lcm',
    'username' => 'xxx',
    'password' => 'xxx',
    'charset' => 'utf8',
    'tablePrefix'=>'lcm_',
    // Schema cache options (for production environment)
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 3600,
    'schemaCache' => 'cache',
];
