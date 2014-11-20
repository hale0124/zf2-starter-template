<?php
/**
 * Doctrine 2 configuration
 */

return [
    'doctrine' => [
        'orm_autoload_annotations' => true,

        'connection' => [
            'orm_default' => [
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => [
                    'host' => 'localhost',
                    'port'     => '3306',
                    'charset'  => 'UTF8',
                ],
            ],
        ],

        'configuration' => [
            'orm_default' => [
                'hydration_cache'   => 'apc',
                'metadata_cache'    => 'apc',
                'query_cache'       => 'apc',
                'result_cache'      => 'apc',
                'driver'            => 'orm_default',
                'generate_proxies'  => false,
                'proxy_dir'         => './data/doctrine/proxy',
                'proxy_namespace'   => 'Doctrine\ORM\Proxy',
                'filters'           => [
                    'soft-deleteable' => 'Gedmo\SoftDeleteable\Filter\SoftDeleteableFilter',
                ],
            ],
        ],

        'eventmanager' => [
            'orm_default' => [
                'subscribers' => [
                    'doctrine_extensions.blameable',
                    'doctrine_extensions.iptraceable',
                    'doctrine_extensions.loggable',
                    'doctrine_extensions.uploadable',
                    'doctrine_extensions.translatable',
                    'doctrine_extensions.softdeleteable',
                    'Gedmo\Sluggable\SluggableListener',
                    'Gedmo\Sortable\SortableListener',
                    'Gedmo\Timestampable\TimestampableListener',
                    'Gedmo\Tree\TreeListener',
                ],
            ],
        ],
    ],
];
