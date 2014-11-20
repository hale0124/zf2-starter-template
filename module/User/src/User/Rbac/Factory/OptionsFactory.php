<?php

namespace User\Rbac\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use User\Rbac\Options;

class OptionsFactory implements FactoryInterface
{
    /**
     * Get options
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return Options
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new Options($serviceLocator->get('config')['user_rbac']);
    }
}
