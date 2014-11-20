<?php

namespace User\Form;

use Zend\Form\Element;
use ZfcBase\Form\ProvidesEventsForm;

/**
 * Password reset form
 */
class ResetForm extends ProvidesEventsForm
{
    /**
     * {@inheritDoc}
     */
    public function __construct($name = null)
    {
        parent::__construct($name);

        $this->add([
            'name' => 'newCredential',
            'options' => [
                'label' => 'New Password',
            ],
            'attributes' => [
                'type' => 'password',
            ],
        ]);

        $this->add([
            'name' => 'newCredentialVerify',
            'options' => [
                'label' => 'Verify New Password',
            ],
            'attributes' => [
                'type' => 'password',
            ],
        ]);

        $submitElement = new Element\Button('submit');
        $submitElement
            ->setLabel('Set new password')
            ->setAttributes([
                'type' => 'submit',
            ]);

        $this->add($submitElement, [
            'priority' => -100,
        ]);

        $this->getEventManager()->trigger('init', $this);
    }
}
