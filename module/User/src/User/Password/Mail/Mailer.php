<?php

namespace User\Password\Mail;

use MtMail\Service\Mail as MailService;
use ZfcUser\Entity\UserInterface;
use Base\Interfaces\MailServiceAwareInterface;
use Base\Traits\MailServiceAwareTrait;
use Base\Traits\OptionsAwareTrait;
use User\Entity\Password as PasswordEntity;
use User\Password\Options;

/**
 * Password mailer
 */
class Mailer implements
    MailServiceAwareInterface
{
    use MailServiceAwareTrait;
    use OptionsAwareTrait;

    /**
     * Constructor
     *
     * @param MailService $mailService
     * @param Options     $options
     */
    public function __construct(
        MailService $mailService,
        Options $options
    ) {
        $this->setMailService($mailService);
        $this->setOptions($options);
    }

    /**
     * Send forgot password email message
     *
     * @param PasswordEntity $model
     * @param UserInterface  $user
     */
    public function sendForgotEmailMessage(PasswordEntity $model, UserInterface $user)
    {
        $variables = [
            'template' => $this->getOptions()->getResetEmailTemplate(),
            'subject' => $this->getOptions()->getResetEmailSubjectLine(),
            'view' => ['record' => $model],
        ];

        $this->sendMail([$user], $variables);
    }
}
