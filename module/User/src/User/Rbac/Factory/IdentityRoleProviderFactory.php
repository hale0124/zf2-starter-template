<?php

namespace User\Rbac\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use User\Rbac\Identity\IdentityRoleProvider;

class IdentityRoleProviderFactory implements FactoryInterface
{
    /**
     * Gets identity role provider
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return IdentityRoleProvider
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $identityRoleProvider = new IdentityRoleProvider(
            $serviceLocator->get('User\Rbac\Options'),
            $serviceLocator->get('Doctrine\ORM\EntityManager')
        );

        if ($serviceLocator->get('zfcuser_auth_service')->hasIdentity()) {
            $identityRoleProvider->setDefaultIdentity(
                $serviceLocator->get('zfcuser_auth_service')->getIdentity()
            );
        }

        return $identityRoleProvider;
    }
}
