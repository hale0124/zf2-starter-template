<?php

namespace Base\Traits;

use MtMail\Service\Mail as MailService;
use User\Entity\User;

/**
 * Mail service trait
 */
trait MailServiceAwareTrait
{
    /**
     * @var MailService
     */
    protected $mailService;

    /**
     * Get mail service
     *
     * @return MailService
     */
    public function getMailService()
    {
        return $this->mailService;
    }

    /**
     * Set mail service
     *
     * @param  MailService           $mailService
     * @return MailServiceAwareTrait
     */
    public function setMailService(MailService $mailService)
    {
        $this->mailService = $mailService;

        return $this;
    }

    /**
     * Send mail
     *
     * @param  array $entities
     * @param  array $variables
     * @return void
     */
    protected function sendMail(array $entities, array $variables = [])
    {
        $message = $this->getMailService()->compose(
            ['to' => ''],
            $variables['template'],
            $variables['view']
        );

        foreach ($entities as $entity) {
            if ($entity instanceof User) {
                $message->addTo($entity->getEmail());
            } else {
                if (method_exists($entity, 'getUser')) {
                    $message->addTo($entity->getUser()->getEmail());
                }
            }
        }

        if (array_key_exists('fromEmail', $variables)) {
            $message->setFrom($variables['fromEmail']);
        } else {
            $message->setFrom('noreply@oapple.co.za');
        }

        $message->setSubject($variables['subject']);

        return $this->getMailService()->send($message);
    }
}
