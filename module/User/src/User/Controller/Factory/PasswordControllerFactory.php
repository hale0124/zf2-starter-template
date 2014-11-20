<?php

namespace User\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use User\Controller\PasswordController;

class PasswordControllerFactory implements
    FactoryInterface
{
    /**
     * Password controller factory
     *
     * @param  ServiceLocatorInterface $controllers
     * @return PasswordController
     */
    public function createService(ServiceLocatorInterface $controllers)
    {
        return new PasswordController(
            $controllers->getServiceLocator()->get('Doctrine\ORM\EntityManager'),
            $controllers->getServiceLocator()->get('User\Password\Service\Password'),
            $controllers->getServiceLocator()->get('User\Form\ForgotForm'),
            $controllers->getServiceLocator()->get('User\Form\ResetForm'),
            $controllers->getServiceLocator()->get('User\Password\Options'),
            $controllers->getServiceLocator()->get('zfcuser_module_options')
        );
    }
}
