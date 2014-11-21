<?php
/**
 * Elastic Search configuration
 */

return [
    'elastica' => [
        'servers' => [
            [
                'host' => '127.0.0.1',
                'port' => 9200,
            ],
        ],
    ],

    'service_manager' => [
        'factories' => [
            'Base\Service\ElasticaClient' => 'Base\Factory\ElasticaClientFactory',
        ],
    ],
];
