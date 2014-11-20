<?php
/**
 * AssetManager configuration
 */

return [
    'asset_manager' => [
        'resolver_configs' => [
            // path
            'paths' => [
                __DIR__.'/../assets',
            ],

            'collections' => [
                // vendor stylesheets
                'css/vendor.css' => [
                    'css/bootstrap.min.css',
                    'css/font-awesome.min.css',
                ],

                // conditional javascript
                'js/conditionals.js' => [
                    'js/vendor/html5shiv.js',
                    'js/vendor/respond.min.js',
                ],

                // vendor javascript
                'js/vendor.js' => [
                    'js/vendor/jquery-1.11.1.min.js',
                    'js/vendor/bootstrap.min.js',
                ],
            ],
        ],

        'filters' => [
            'css/vendor.css' => [
                [
                    'filter' => 'Assetic\Filter\CssMinFilter',
                ],
            ],
            'js/vendor/modernizr.min.js' => [
                [
                    'filter' => 'Assetic\Filter\JsMinFilter',
                ],
            ],
            'js/conditionals.js' => [
                [
                    'filter' => 'Assetic\Filter\JsMinFilter',
                ],
            ],
            'js/vendor.js' => [
                [
                    'filter' => 'Assetic\Filter\JsMinFilter',
                ],
            ],
        ],
    ],
];
