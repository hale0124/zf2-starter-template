<?php
/**
 * User Forgot Password Configuration
 */

return [
    'user_password' => [
        'reset_email_subject_line' => 'You have requested to reset your password',
        'reset_email_template' => 'user/password/mail/forgot',

        'password_entity_class' => 'User\Entity\Password',

        'reset_expire' => 86400,

        'validate_existing_record' => true,
    ],
];
