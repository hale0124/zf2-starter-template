<?php

namespace User\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SetPasswordFormFactory implements
    FactoryInterface
{
    /**
     * Get the set password form
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return \Zend\Form\Form
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $changePasswordForm = $serviceLocator->get('zfcuser_change_password_form');
        $form = clone $changePasswordForm;
        foreach (array('identity', 'credential') as $field) {
            $form->remove($field);
            $form->getInputFilter()->remove($field);
        }

        return $form;
    }
}
