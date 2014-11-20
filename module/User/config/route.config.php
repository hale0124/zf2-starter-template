<?php
/**
 * Route configuration
 */

return [
    'router' => [
        'routes' => [
            'zfcuser' => [
                'child_routes' => [
                    'verify_email' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/verify-email/:userId/:token',
                            'defaults' => [
                                'controller' => 'User\Controller\Registration',
                                'action' => 'verify-email',
                            ],
                        ],
                    ],
                    'set_password' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/set-password/:userId/:token',
                            'defaults' => [
                                'controller' => 'User\Controller\Registration',
                                'action' => 'set-password',
                            ],
                        ],
                    ],
                    'forgotpassword' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/forgot-password',
                            'defaults' => [
                                'controller' => 'User\Controller\Password',
                                'action' => 'forgot',
                            ],
                        ],
                    ],
                    'resetpassword' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/reset-password/:userId/:token',
                            'defaults' => [
                                'controller' => 'User\Controller\Password',
                                'action' => 'reset',
                            ],
                            'constraints' => [
                                'userId' => '[A-Fa-f0-9]+',
                                'token' => '[A-F0-9]+',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
