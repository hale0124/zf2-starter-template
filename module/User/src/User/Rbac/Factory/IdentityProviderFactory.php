<?php

namespace User\Rbac\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use User\Rbac\Identity\IdentityProvider;

class IdentityProviderFactory implements FactoryInterface
{
    /**
     * Get identity provider
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return IdentityProvider
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new IdentityProvider($serviceLocator->get('User\Rbac\Identity\IdentityRoleProvider'));
    }
}
