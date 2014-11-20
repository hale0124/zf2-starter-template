<?php

namespace User\Form;

use Zend\Form\Element;
use ZfcBase\Form\ProvidesEventsForm;

/**
 * Forgot password form
 */
class ForgotForm extends ProvidesEventsForm
{
    /**
     * {@inheritDoc}
     */
    public function __construct($name = null)
    {
        parent::__construct($name);

        $this->add([
            'name' => 'email',
            'options' => [
                'label' => 'Email',
            ],
        ]);

        $submitElement = new Element\Button('submit');
        $submitElement
            ->setLabel('Request new password')
            ->setAttributes([
                'type' => 'submit',
            ]);

        $this->add($submitElement, [
            'priority' => -100,
        ]);

        $this->getEventManager()->trigger('init', $this);
    }
}
