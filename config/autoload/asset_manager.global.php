<?php
/**
 * Asset Manager configuration
 */

return [
    'asset_manager' => [
        'caching' => [
            'default' => [
                'cache' => 'Assetic\Cache\ApcCache',
            ],
        ],
    ],
];
