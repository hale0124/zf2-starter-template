<?php

namespace Base\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Elastica\Client;

class ElasticaClientFactory implements
    FactoryInterface
{
    /**
     * Get the elastica client
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return Client
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new Client($serviceLocator->get('config')['elastica']);
    }
}
