<?php

namespace User\Form\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use ZfcUser\Form\LoginFilter;
use User\Form\LoginForm;

class LoginFormFactory implements
    FactoryInterface
{
    /**
     * Login form factory
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return LoginForm
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = $serviceLocator->get('zfcuser_module_options');

        $form = new LoginForm(null, $options);
        $form->setInputFilter(new LoginFilter($options));

        return $form;
    }
}
