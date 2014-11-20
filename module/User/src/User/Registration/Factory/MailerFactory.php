<?php

namespace User\Registration\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use User\Registration\Mail\Mailer;

class MailerFactory implements
    FactoryInterface
{
    /**
     * Get the registration mailer
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return Mailer
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new Mailer(
            $serviceLocator->get('MtMail\Service\Mail'),
            $serviceLocator->get('User\Registration\Options')
        );
    }
}
