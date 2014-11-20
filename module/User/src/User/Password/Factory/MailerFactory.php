<?php

namespace User\Password\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use User\Password\Mail\Mailer;

class MailerFactory implements
    FactoryInterface
{
    /**
     * Get the password mailer
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return Mailer
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new Mailer(
            $serviceLocator->get('MtMail\Service\Mail'),
            $serviceLocator->get('User\Password\Options')
        );
    }
}
