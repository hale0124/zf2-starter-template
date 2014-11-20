<?php

namespace User\Form\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use User\Form\ResetForm;
use User\Form\Filter\ResetFormFilter;

class ResetFormFactory implements
    FactoryInterface
{
    /**
     * Reset form factory
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return ResetForm
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = $serviceLocator->get('User\Password\Options');

        $form = new ResetForm(null, $options);
        $form->setInputFilter(new ResetFormFilter());

        return $form;
    }
}
