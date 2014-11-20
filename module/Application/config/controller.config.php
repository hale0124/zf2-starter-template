<?php
/**
 * Controller configuration
 */

return [
    'invokables' => [
        'Application\Controller\Index' => 'Application\Controller\IndexController',
    ],
    'factories' => [
        'DoctrineORMModule\Yuml\YumlController' => 'Application\Controller\Factory\YumlControllerFactory',
    ],
];
