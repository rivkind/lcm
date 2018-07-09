<?php

return [
    'class' => 'Edvlerblog\Adldap2\Adldap2Wrapper',

    'providers' => [
        'default' => [
            // Connect this provider on initialisation of the LdapWrapper Class automatically
            'autoconnect' => true,

            'config' => [
                'account_suffix'        => 'xxx',
                'domain_controllers'    => ['xxx'],
                'base_dn'               => 'xxx',
                'admin_username'        => 'xxx',
                'admin_password'        => 'xxx',
            ]
        ],
    ],
];