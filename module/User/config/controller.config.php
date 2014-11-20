<?php
/**
 * Controller configuration
 */

return [
    'factories' => [
        'User\Controller\Password' => 'User\Controller\Factory\PasswordControllerFactory',
        'User\Controller\Registration' => 'User\Controller\Factory\RegistrationControllerFactory',
    ]
];
