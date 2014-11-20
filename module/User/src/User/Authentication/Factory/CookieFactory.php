<?php

namespace User\Authentication\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use User\Authentication\Adapter\Cookie;

class CookieFactory implements
    FactoryInterface
{
    /**
     * Get cookie adapter
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return Cookie
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new Cookie(
            $serviceLocator->get('Doctrine\ORM\EntityManager'),
            $serviceLocator->get('User\Cookie\Service\Cookie'),
            $serviceLocator->get('User\Cookie\Options')
        );
    }
}
