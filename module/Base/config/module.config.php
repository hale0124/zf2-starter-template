<?php
/**
 * Module configuration
 */

namespace Base;

return [
    'doctrine' => [
        'driver' => [
            strtolower(__NAMESPACE__) => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'paths' => [__DIR__.'/../src/'.__NAMESPACE__.'/Entity'],
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__.'\Entity' => strtolower(__NAMESPACE__),
                ],
            ],
        ],
    ],
];
