<?php

namespace User\Form\Filter;

use Zend\InputFilter\InputFilter;
use DoctrineModule\Validator\ObjectExists;
use User\Password\Options;

/**
 * Forgot password form filter
 */
class ForgotFormFilter extends InputFilter
{
    /**
     * @var Options
     */
    protected $options;

    /**
     * Constructor
     *
     * @param ObjectExists $emailValidator
     * @param Options      $options
     */
    public function __construct(ObjectExists $emailValidator, Options $options)
    {
        $this->setOptions($options);
        $this->emailValidator = $emailValidator;

        $this->add(array(
            'name'       => 'email',
            'required'   => true,
            'validators' => array(
                array(
                    'name' => 'EmailAddress',
                ),
            ),
        ));

        if ($this->getOptions()->getValidateExistingRecord()) {
            $this->add(array(
                'name'       => 'email',
                'validators' => array(
                    $this->emailValidator,
                ),
            ));
        }
    }

    /**
     * Set options
     *
     * @param  Options          $options
     * @return ForgotFormFilter
     */
    public function setOptions(Options $options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Get options
     *
     * @return Options
     */
    public function getOptions()
    {
        return $this->options;
    }
}
