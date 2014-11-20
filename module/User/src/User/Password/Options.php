<?php

namespace User\Password;

/**
 * Password reset options class
 */
use Zend\Stdlib\AbstractOptions;

class Options extends AbstractOptions
{
    /**
     * @var boolean
     */
    protected $validateExistingRecord = false;

    /**
     * @var string
     */
    protected $resetEmailSubjectLine = 'You have requested a password reset';

    /**
     * @var string
     */
    protected $resetEmailTemplate = 'user/password/mail/forgot';

    /**
     * @var string
     */
    protected $passwordEntityClass = 'User\Entity\Password';

    /**
     * @var int
     */
    protected $resetExpire = 86400;

    /**
     * Get validate existing record
     *
     * @return boolean
     */
    public function getValidateExistingRecord()
    {
        return $this->validateExistingRecord;
    }

    /**
     * Set validate existing record
     *
     * @param  integer $validateExistingRecord
     * @return Options
     */
    public function setValidateExistingRecord($validateExistingRecord)
    {
        $this->validateExistingRecord = $validateExistingRecord;

        return $this;
    }

    /**
     * Get reset email subject line
     *
     * @return type
     */
    public function getResetEmailSubjectLine()
    {
        return $this->resetEmailSubjectLine;
    }

    /**
     * Set reset email subject line
     *
     * @param  string  $resetEmailSubjectLine
     * @return Options
     */
    public function setResetEmailSubjectLine($resetEmailSubjectLine)
    {
        $this->resetEmailSubjectLine = $resetEmailSubjectLine;

        return $this;
    }

    /**
     * Get reset email template
     *
     * @return string
     */
    public function getResetEmailTemplate()
    {
        return $this->resetEmailTemplate;
    }

    /**
     * Set reset email template
     *
     * @param  string  $resetEmailTemplate
     * @return Options
     */
    public function setResetEmailTemplate($resetEmailTemplate)
    {
        $this->resetEmailTemplate = $resetEmailTemplate;

        return $this;
    }

    /**
     * Get password entity class
     *
     * @return string
     */
    public function getPasswordEntityClass()
    {
        return $this->passwordEntityClass;
    }

    /**
     * Set password entity class
     *
     * @param  string  $passwordEntityClass
     * @return Options
     */
    public function setPasswordEntityClass($passwordEntityClass)
    {
        $this->passwordEntityClass = $passwordEntityClass;

        return $this;
    }

    /**
     * Get reset expire
     *
     * @return integer
     */
    public function getResetExpire()
    {
        return $this->resetExpire;
    }

    /**
     * Set reset expire
     *
     * @param  integer $resetExpire
     * @return Options
     */
    public function setResetExpire($resetExpire)
    {
        $this->resetExpire = $resetExpire;

        return $this;
    }
}
