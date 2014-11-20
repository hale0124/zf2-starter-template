<?php

namespace User\Registration\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use User\Registration\Options;

class OptionsFactory implements
    FactoryInterface
{
    /**
     * Get user registration options
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return Options
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new Options($serviceLocator->get('config')['user_registration']);
    }
}
