<?php

namespace User\Password\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use User\Password\Options;

class OptionsFactory implements
    FactoryInterface
{
    /**
     * Get user password options
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return Options
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new Options($serviceLocator->get('config')['user_password']);
    }
}
