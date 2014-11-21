<?php

namespace Base\Initializers;

use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Base\Interfaces\ElasticaAwareInterface;

class ElasticaInitializer implements
    InitializerInterface
{
    /**
     * Initialize elastica
     *
     * @param ElasticaAwareInterface  $service
     * @param ServiceLocatorInterface $serviceManager
     */
    public function initialize($service, ServiceLocatorInterface $serviceManager)
    {
        if ($service instanceof ElasticaAwareInterface) {
            var_dump('Ran');
            $service->setElasticaClient($serviceManager->get('Base\Service\ElasticaClient'));
        }
    }
}
