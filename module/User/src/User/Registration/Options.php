<?php

namespace User\Registration;

use Zend\Stdlib\AbstractOptions;

/**
 * Registration options
 */
class Options extends AbstractOptions
{
    /**
     * @var string|array
     */
    protected $emailFromAddress = '';

    /**
     * @var string
     */
    protected $verificationEmailTemplate = 'user/mail/verify-email';

    /**
     * @var string
     */
    protected $passwordRequestEmailTemplate = 'user/mail/set-password';

    /**
     * @var boolean
     */
    protected $enableRequestExpiry = true;

    /**
     * @var int
     */
    protected $requestExpiry = 86400;

    /**
     * @var string
     */
    protected $registrationEntityClass = 'User\Entity\Registration';

    /**
     * @var boolean
     */
    protected $sendVerificationEmail = true;

    /**
     * @var boolean
     */
    protected $sendPasswordRequestEmail = true;

    /**
     * @var string
     */
    protected $verificationEmailSubject = 'Email Address Verification';

    /**
     * @var string
     */
    protected $passwordRequestEmailSubject = 'Set Your Password';

    /**
     * @var string
     */
    protected $postVerificationRoute = 'zfcuser/login';

    /**
     * Get from email address
     *
     * @return string|array
     */
    public function getEmailFromAddress()
    {
        return $this->emailFromAddress;
    }

    /**
     * Set email from address
     *
     * @param  string|array $emailFromAddress
     * @return Options
     */
    public function setEmailFromAddress($emailFromAddress)
    {
        $this->emailFromAddress = $emailFromAddress;

        return $this;
    }

    /**
     * Get verification email template
     *
     * @return string
     */
    public function getVerificationEmailTemplate()
    {
        return $this->verificationEmailTemplate;
    }

    /**
     * Set verification email template
     *
     * @param  string  $verificationEmailTemplate
     * @return Options
     */
    public function setVerificationEmailTemplate($verificationEmailTemplate)
    {
        $this->verificationEmailTemplate = $verificationEmailTemplate;

        return $this;
    }

    /**
     * Get password request email template
     *
     * @return string
     */
    public function getPasswordRequestEmailTemplate()
    {
        return $this->passwordRequestEmailTemplate;
    }

    /**
     * Set password request email template
     *
     * @param  string  $passwordRequestEmailTemplate
     * @return Options
     */
    public function setPasswordRequestEmailTemplate($passwordRequestEmailTemplate)
    {
        $this->passwordRequestEmailTemplate = $passwordRequestEmailTemplate;

        return $this;
    }

    /**
     * Get enable request expiry
     *
     * @return boolean
     */
    public function getEnableRequestExpiry()
    {
        return $this->enableRequestExpiry;
    }

    /**
     * Set enable request expiry
     *
     * @param  boolean $enableRequestExpiry
     * @return Options
     */
    public function setEnableRequestExpiry($enableRequestExpiry)
    {
        $this->enableRequestExpiry = $enableRequestExpiry;

        return $this;
    }

    /**
     * Get request expiry
     *
     * @return integer
     */
    public function getRequestExpiry()
    {
        return $this->requestExpiry;
    }

    /**
     * Set request expiry
     *
     * @param  integer $requestExpiry
     * @return Options
     */
    public function setRequestExpiry($requestExpiry)
    {
        $this->requestExpiry = $requestExpiry;

        return $this;
    }

    /**
     * Get registration entity class
     *
     * @return string
     */
    public function getRegistrationEntityClass()
    {
        return $this->registrationEntityClass;
    }

    /**
     * Set registration entity class
     *
     * @param  string  $registrationEntityClass
     * @return Options
     */
    public function setRegistrationEntityClass($registrationEntityClass)
    {
        $this->registrationEntityClass = $registrationEntityClass;

        return $this;
    }

    /**
     * Get send verification email
     *
     * @return string
     */
    public function getSendVerificationEmail()
    {
        return $this->sendVerificationEmail;
    }

    /**
     * Set send verification email
     *
     * @param  string  $sendVerificationEmail
     * @return Options
     */
    public function setSendVerificationEmail($sendVerificationEmail)
    {
        $this->sendVerificationEmail = $sendVerificationEmail;

        return $this;
    }

    /**
     * Get send password request email
     *
     * @return boolean
     */
    public function getSendPasswordRequestEmail()
    {
        return $this->sendPasswordRequestEmail;
    }

    /**
     * Set send password request email
     *
     * @param  string  $sendPasswordRequestEmail
     * @return Options
     */
    public function setSendPasswordRequestEmail($sendPasswordRequestEmail)
    {
        $this->sendPasswordRequestEmail = $sendPasswordRequestEmail;

        return $this;
    }

    /**
     * Get verification email subject
     *
     * @return string
     */
    public function getVerificationEmailSubject()
    {
        return $this->verificationEmailSubject;
    }

    /**
     * Set verification email subject
     *
     * @param  string  $verificationEmailSubject
     * @return Options
     */
    public function setVerificationEmailSubject($verificationEmailSubject)
    {
        $this->verificationEmailSubject = $verificationEmailSubject;

        return $this;
    }

    /**
     * Get password request email subject
     *
     * @return string
     */
    public function getPasswordRequestEmailSubject()
    {
        return $this->passwordRequestEmailSubject;
    }

    /**
     * Set password request email subject
     *
     * @param  string  $passwordRequestEmailSubject
     * @return Options
     */
    public function setPasswordRequestEmailSubject($passwordRequestEmailSubject)
    {
        $this->passwordRequestEmailSubject = $passwordRequestEmailSubject;

        return $this;
    }

    /**
     * Get post verification route
     *
     * @return string
     */
    public function getPostVerificationRoute()
    {
        return $this->postVerificationRoute;
    }

    /**
     * Set post verification route
     *
     * @param  string  $postVerificationRoute
     * @return Options
     */
    public function setPostVerificationRoute($postVerificationRoute)
    {
        $this->postVerificationRoute = $postVerificationRoute;

        return $this;
    }
}
