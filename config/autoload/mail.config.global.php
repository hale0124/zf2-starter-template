<?php

return [
    'mt_mail' => [
        'transport' => 'Zend\Mail\Transport\Smtp',
        'transport_options' => [
            'host' => 'smtp.oapple.co.za',
            'port' => 587,
            'connection_class' => 'login',
            'connection_config' => [
                'ssl' => 'tls',
            ],
        ],

        /*
         * List of enabled plugins
         * Uncomment name of plugin you want to enable, then uncomment and edit its options below
         */
        'composer_plugins' => [
            'DefaultHeaders',
            'Layout',
            'MessageEncoding',
        ],

        /*
         * Plugin configuration
         */

        // default headers
        'default_headers' => [
            'from' => 'The Orange Apple <noreply@oapple.co.za>',
            'reply-to' => 'Website Admin <jean@oapple.co.za>',
        ],

        // message layout - path to view script
        'layout' => 'layout/mail',

        // example message encoding
        'message_encoding' => 'UTF-8',
    ],
];
