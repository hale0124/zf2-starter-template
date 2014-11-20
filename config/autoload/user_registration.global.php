<?php
/**
* User Registration Configuration
*/
return [
    'user_registration' => [
        'email_from_address' => [
            'noreply@oapple.co.za' => 'The Orange Apple',
        ],

        'verification_email_template' => 'user/registration/mail/verify-email',
        'password_request_email_template' => 'user/registration/mail/set-password',

        'enable_request_expiry' => true,
        'request_expiry' => 86400,

        'registration_entity_class' => 'User\Entity\Registration',

        'send_verification_email' => true,
        'send_password_request_email' => true,

        'verification_email_subject' => 'Email Address Verification',
        'password_request_email_subject' => 'Set Your Password',

        'post_verification_route' => 'zfcuser/login',
    ],
];
