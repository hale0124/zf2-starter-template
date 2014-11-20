<?php

namespace User\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use User\Controller\RegistrationController;

class RegistrationControllerFactory implements
    FactoryInterface
{
    /**
     * Get the registration controller
     *
     * @param  ServiceLocatorInterface $cpm
     * @return RegistrationController
     */
    public function createService(ServiceLocatorInterface $cpm)
    {
        return new RegistrationController(
            $cpm->getServiceLocator()->get('Doctrine\ORM\EntityManager'),
            $cpm->getServiceLocator()->get('User\Registration\Options'),
            $cpm->getServiceLocator()->get('User\Registration\Service\Registration')
        );
    }
}
