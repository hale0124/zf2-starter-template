<?php
/**
 * Role based access control configuration
 */

return [
    'user_rbac' => [
        'default_guest_role' => 'Guest',
        'default_user_role' => 'Member',
    ],

    'zfc_rbac' => [
        'role_provider' => [
            'ZfcRbac\Role\InMemoryRoleProvider' => [

                'Administrator' => [
                    'children'    => [],
                    'permissions' => [],
                ],

                'Member' => [
                    'children'    => [],
                    'permissions' => [],
                ],

                'Guest' => [
                    'permissions' => [],
                ],
            ],
        ],

        'identity_provider' => 'User\Rbac\Identity\IdentityProvider',

        'redirect_strategy' => [
            'redirect_when_connected'           => true,
            'redirect_to_route_connected'       => 'zfcuser',
            'redirect_to_route_disconnected'    => 'zfcuser/login',
            'append_previous_uri'               => false,
            'previous_uri_query_key'            => 'redirect',
        ],

        'unauthorized_strategy' => [
            'template' => 'error/403',
        ],

        //'guards' => [],
    ],
];
