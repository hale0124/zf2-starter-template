<?php
/**
 * Service configuration
 */

return [
    'factories' => [
        'User\Rbac\Options' => 'User\Rbac\Factory\OptionsFactory',
        'User\Rbac\Identity\IdentityProvider' => 'User\Rbac\Factory\IdentityProviderFactory',
        'User\Rbac\Identity\IdentityRoleProvider' => 'User\Rbac\Factory\IdentityRoleProviderFactory',
        'User\Rbac\View\Strategy\SmartRedirectStrategy' => 'User\Rbac\Factory\SmartRedirectStrategyFactory',

        'User\Authentication\Adapter\EmailVerification' => 'User\Authentication\Factory\EmailVerificationFactory',
        'User\Form\SetPasswordForm' => 'User\Form\Factory\SetPasswordFormFactory',
        'User\Registration\Mail\Mailer' => 'User\Registration\Factory\MailerFactory',
        'User\Registration\Options' => 'User\Registration\Factory\OptionsFactory',
        'User\Registration\Service\Registration' => 'User\Registration\Factory\RegistrationServiceFactory',

        'User\Form\ForgotForm' => 'User\Form\Factory\ForgotFormFactory',
        'User\Form\ResetForm' => 'User\Form\Factory\ResetFormFactory',
        'User\Password\Mail\Mailer' => 'User\Password\Factory\MailerFactory',
        'User\Password\Options' => 'User\Password\Factory\OptionsFactory',
        'User\Password\Service\Password' => 'User\Password\Factory\PasswordServiceFactory',

        'zfcuser_login_form' => 'User\Form\Factory\LoginFormFactory',
        'User\Authentication\Adapter\Cookie' => 'User\Authentication\Factory\CookieFactory',
        'User\Cookie\Options' => 'User\Cookie\Factory\OptionsFactory',
        'User\Cookie\Service\Cookie' => 'User\Cookie\Factory\CookieServiceFactory',
    ],

    'aliases' => [
        'Zend\Authentication\AuthenticationService' => 'zfcuser_auth_service',
    ],
];
