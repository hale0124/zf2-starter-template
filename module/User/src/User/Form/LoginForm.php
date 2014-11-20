<?php

namespace User\Form;

use ZfcUser\Options\AuthenticationOptionsInterface;
use ZfcUser\Form\Login as ZfcLoginForm;

class LoginForm extends ZfcLoginForm
{
    /**
     * @var AuthenticationOptionsInterface
     */
    protected $authOptions;

    /**
     * Constructor
     *
     * @param string                         $name
     * @param AuthenticationOptionsInterface $options
     */
    public function __construct($name = null, AuthenticationOptionsInterface $options)
    {
        parent::__construct($name, $options);

        $this->add([
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'remember_me',
            'options' => [
                'label' => 'Stay logged in',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0',
            ],
        ]);
    }
}
