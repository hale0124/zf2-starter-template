<?php

namespace Base\Traits;

/**
 * Mailer trait
 */
trait MailerTrait
{
    /**
     * @var MailServiceInterface
     */
    protected $mailer;

    /**
     * Get mailer
     *
     * @return type
     */
    public function getMailer()
    {
        return $this->mailer;
    }

    /**
     * Set mailer
     *
     * @param  MailServiceInterface $mailer
     * @return type
     */
    public function setMailer($mailer)
    {
        $this->mailer = $mailer;

        return $this;
    }
}
