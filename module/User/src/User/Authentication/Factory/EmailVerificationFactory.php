<?php

namespace User\Authentication\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use User\Authentication\Adapter\EmailVerification;

class EmailVerificationFactory implements
    FactoryInterface
{
    /**
     * Get email verification adapter
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return EmailVerification
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new EmailVerification($serviceLocator->get('Doctrine\ORM\EntityManager'));
    }
}
