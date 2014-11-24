<?php

namespace Base\Traits;

/**
 * Mailer trait
 */
trait MailerAwareTrait
{
    /**
     * @var MailServiceAwareInterface
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
     * @param  MailServiceAwareInterface $mailer
     * @return type
     */
    public function setMailer($mailer)
    {
        $this->mailer = $mailer;

        return $this;
    }
}
