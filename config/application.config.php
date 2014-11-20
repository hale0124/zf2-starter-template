<?php

//$env = getenv('APP_ENV') ?: 'production';
$env = 'development';

$modules = [
    'HtSession',
    'HtImgModule',
    'MtMail',
    'DoctrineModule',
    'DoctrineORMModule',
    'ZfcBase',
    'ZfcUser',
    'ZfcUserDoctrineORM',
    'ZfcRbac',
    'AssetManager',
    'TwbBundle',
    'Application',
    'Base',
    'User',
];

if ($env === 'development') {
    $modules[] = 'ZendDeveloperTools';
}

return [
    'modules' => $modules,
    'module_listener_options' => [
        'module_paths' => [
            './module',
            './vendor',
        ],
        'config_glob_paths' => [
            'config/autoload/{,*.}{global,local}.php',
        ],
        // Use the $env value to determine the state of the flag
        'config_cache_enabled' => ($env == 'production'),
        'config_cache_key' => 'app_config',

        // Use the $env value to determine the state of the flag
        'module_map_cache_enabled' => ($env == 'production'),
        'module_map_cache_key' => 'module_map',
        'cache_dir' => './data/cache/',

        // Use the $env value to determine the state of the flag
        'check_dependencies' => ($env != 'production'),
    ]
];
