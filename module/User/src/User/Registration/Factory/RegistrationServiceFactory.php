<?php

namespace User\Registration\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use User\Registration\Service\Registration;

class RegistrationServiceFactory implements
    FactoryInterface
{
    /**
     * Get registration service
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return Registration
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new Registration(
            $serviceLocator->get('Doctrine\ORM\EntityManager'),
            $serviceLocator->get('User\Registration\Mail\Mailer'),
            $serviceLocator->get('User\Registration\Options'),
            $serviceLocator->get('zfcuser_module_options')
        );
    }
}
