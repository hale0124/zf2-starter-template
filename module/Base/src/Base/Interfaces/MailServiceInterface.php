<?php

namespace Base\Interfaces;

use MtMail\Service\Mail as MailService;

interface MailServiceInterface
{
    public function getMailService();
    public function setMailService(MailService $mailService);
}
