<?php
/**
 * Service configuration
 */

return [
    'abstract_factories' => [
        'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
        'Zend\Log\LoggerAbstractServiceFactory',
    ],

    'aliases' => [
        'translator' => 'MvcTranslator',
    ],
];
