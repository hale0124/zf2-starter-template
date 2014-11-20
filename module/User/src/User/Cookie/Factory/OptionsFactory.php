<?php

namespace User\Cookie\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use User\Cookie\Options;

class OptionsFactory implements
    FactoryInterface
{
    /**
     * Get cookie options
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return Options
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new Options($serviceLocator->get('config')['user_cookie']);
    }
}
