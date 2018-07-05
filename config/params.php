<?php

return [
    'language' => 'ru', // Set the language here
    'adminEmail' => 'admin@example.com',
    'fileUploadUrl' => 'uploads/',
    'dateFormat' => 'Y.MM.dd HH:mm',
    'dateFormatDay' => 'Y.MM.dd',
    'updateTime' => 365,
    'LDAP-Group-Assignment-Options' => [
        'LOGIN_POSSIBLE_WITH_ROLE_ASSIGNED_MATCHING_REGEX' => "/^(lcm|app)(.*)/", // a role has to be assign, which is starting with yii2 or with app
        'REGEX_GROUP_MATCH_IN_LDAP' => "/^(lcm|app)(.*)/", // Active Directory groups beginning with yii2 or app ar filtered and if a yii2 role with the same name exists the role would be added to the user
        'ADD_GROUPS_FROM_LDAP_MATCHING_REGEX' => true, //add matches between groups and roles to the user
        'REMOVE_ALL_GROUPS_NOT_FOUND_IN_LDAP' => false,
        'REMOVE_ONLY_GROUPS_MATCHING_REGEX' => true, //Only remove groups matching regex REGEX_GROUP_MATCH_IN_LDAP
        'SEARCH_NESTED_GROUPS' => true,
    ],
    'ouUsersAD' => 'OU=ouBest,DC=best,DC=local',
];
