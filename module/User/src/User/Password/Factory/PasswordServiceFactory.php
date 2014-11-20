<?php

namespace User\Password\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use User\Password\Service\Password;

class PasswordServiceFactory implements
    FactoryInterface
{
    /**
     * Get password service
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return Registration
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new Password(
            $serviceLocator->get('Doctrine\ORM\EntityManager'),
            $serviceLocator->get('User\Password\Mail\Mailer'),
            $serviceLocator->get('User\Password\Options'),
            $serviceLocator->get('zfcuser_module_options')
        );
    }
}
