<?php

namespace User\Registration\Mail;

use MtMail\Service\Mail as MailService;
use Base\Interfaces\MailServiceInterface;
use Base\Traits\MailServiceTrait;
use Base\Traits\OptionsTrait;
use User\Registration\Options;

/**
 * Registration mailer
 */
class Mailer implements
    MailServiceInterface
{
    use MailServiceTrait;
    use OptionsTrait;

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
     * Send verification email
     *
     * @param array $registrationRecords
     */
    public function sendVerificationEmail(array $registrationRecords)
    {
        $variables = [
            'template' => $this->getOptions()->getVerificationEmailTemplate(),
            'subject' => $this->getOptions()->getVerificationEmailSubject(),
            'view' => [
                'user' => $registrationRecords[0]->getUser(),
                'registrationRecord' => $registrationRecords[0],
            ],
        ];

        $this->sendMail($registrationRecords, $variables);
    }

    /**
     * Send password request email
     *
     * @param array $registrationRecords
     */
    public function sendPasswordRequestEmail(array $registrationRecords)
    {
        $variables = [
            'template' => $this->getOptions()->getPasswordRequestEmailTemplate(),
            'subject' => $this->getOptions()->getPasswordRequestEmailSubject(),
            'view' => [
                'user' => $registrationRecords[0]->getUser(),
                'registrationRecord' => $registrationRecords[0],
            ],
        ];

        $this->sendMail($registrationRecords, $variables);
    }
}
