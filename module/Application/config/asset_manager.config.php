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
                    'js/vendor/modernizr.min.js',
                    'js/vendor/jquery-1.11.1.min.js',
                    'js/vendor/bootstrap.min.js',
                ],

                // plugin stylesheets
                'css/plugins.css' => [
                    // change these
                    'css/plugins/humane-themes/original.css',
                    'css/plugins/pickadate/classic.css',
                    'css/plugins/pickadate/classic.date.css',
                    'css/plugins/pickadate/classic.time.css',
                    'css/plugins/selectize.bootstrap3.css',
                ],

                // plugin javascript
                'js/plugins.js' => [
                    'js/plugins/plugin.config.min.js',
                    'js/plugins/FileAPI.min.js',
                    'js/plugins/FileAPI.exif.min.js',
                    'js/plugins/jquery.fileapi.min.js',
                    'js/plugins/jquery.jcrop.min.js',
                    'js/plugins/parsley.remote.min.js',
                    'js/plugins/parsley.min.js',
                    'js/plugins/humane.min.js',
                    'js/plugins/picker.min.js',
                    'js/plugins/picker.date.min.js',
                    'js/plugins/picker.time.min.js',
                    'js/plugins/selectize.min.js',
                    'js/plugins/spin.min.js',
                ],
            ],
        ],

        'filters' => [
            'css/vendor.css' => [
                [
                    'filter' => 'Assetic\Filter\CssMinFilter',
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
            'css/plugins.css' => [
                [
                    'filter' => 'Assetic\Filter\CssMinFilter',
                ],
            ],
        ],
    ],
];
