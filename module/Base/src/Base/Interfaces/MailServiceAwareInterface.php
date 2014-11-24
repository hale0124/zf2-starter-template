<?php

namespace Base\Interfaces;

use MtMail\Service\Mail as MailService;

interface MailServiceAwareInterface
{
    public function getMailService();
    public function setMailService(MailService $mailService);
}
