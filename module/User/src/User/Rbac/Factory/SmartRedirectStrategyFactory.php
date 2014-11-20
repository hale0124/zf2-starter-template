<?php

namespace User\Rbac\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use User\Rbac\View\Strategy\SmartRedirectStrategy;

class SmartRedirectStrategyFactory implements FactoryInterface
{
    /**
     * Get SmartRedirectStrategy
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return SmartRedirectStrategy
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new SmartRedirectStrategy($serviceLocator->get('zfcuser_auth_service'));
    }
}
