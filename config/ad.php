<?php

return [
    'class' => 'Edvlerblog\Adldap2\Adldap2Wrapper',

    'providers' => [
        'default' => [
            // Connect this provider on initialisation of the LdapWrapper Class automatically
            'autoconnect' => true,

            'config' => [
                'account_suffix'        => 'xxxx',
                'domain_controllers'    => ['xxxx'],
                'base_dn'               => 'xxxx',
                'admin_username'        => 'xxxx',
                'admin_password'        => 'xxxx',
            ]
        ],
    ],
];