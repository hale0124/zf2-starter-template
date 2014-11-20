<?php

namespace User\Form\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use DoctrineModule\Validator\ObjectExists;
use User\Form\ForgotForm;
use User\Form\Filter\ForgotFormFilter;

class ForgotFormFactory implements
    FactoryInterface
{
    /**
     * Forgot form factory
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return ForgotForm
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $entityManager = $serviceLocator->get('Doctrine\ORM\EntityManager');
        $options = $serviceLocator->get('User\Password\Options');
        $zfcUserOptions = $serviceLocator->get('zfcuser_module_options');

        $validator = new ObjectExists([
            'object_repository' => $entityManager->getRepository($zfcUserOptions->getUserEntityClass()),
            'fields' => 'email',
        ]);

        $validator->setMessage('The email address you entered was not found.');

        $form = new ForgotForm(null);
        $form->setInputFilter(new ForgotFormFilter($validator, $options));

        return $form;
    }
}
