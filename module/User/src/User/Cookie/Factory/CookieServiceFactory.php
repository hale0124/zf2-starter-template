<?php

namespace User\Cookie\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use User\Cookie\Service\Cookie;

class CookieServiceFactory implements
    FactoryInterface
{
    /**
     * Get cookie service
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return Cookie
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new Cookie(
            $serviceLocator->get('Doctrine\ORM\EntityManager'),
            $serviceLocator->get('User\Cookie\Options')
        );
    }
}
