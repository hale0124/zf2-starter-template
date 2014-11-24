<?php

namespace User\Password\Service;

use DateTime;
use Zend\Crypt\Password\Bcrypt;
use Doctrine\ORM\EntityManager;
use ZfcBase\EventManager\EventProvider;
use ZfcUser\Entity\UserInterface;
use ZfcUser\Options\ModuleOptions as ZfcUserOptions;
use Base\Interfaces\MailServiceAwareInterface;
use Base\Traits\EntityManagerAwareTrait;
use Base\Traits\MailerAwareTrait;
use Base\Traits\OptionsAwareTrait;
use User\Entity\Password as PasswordEntity;
use User\Password\Options;

/**
 * Password service
 */
class Password extends EventProvider
{
    use EntityManagerAwareTrait;
    use MailerAwareTrait;
    use OptionsAwareTrait;

    /**
     * @var ZfcUserOptions
     */
    protected $zfcUserOptions;

    public function __construct(
        EntityManager $entityManager,
        MailServiceAwareInterface $mailer,
        Options $options,
        ZfcUserOptions $zfcUserOptions
    ) {
        $this->setEntityManager($entityManager);
        $this->setMailer($mailer);
        $this->setOptions($options);
        $this->setZfcUserOptions($zfcUserOptions);
    }

    /**
     * Process the forgot password request
     *
     * @param UserInterface $user
     */
    public function sendProcessForgotRequest(UserInterface $user)
    {
        $class = $this->getOptions()->getPasswordEntityClass();

        $this->getEntityManager()->getRepository($class)->cleanPriorForgotRequests($user);

        $model = new $class();
        $model->setUser($user);
        $model->setRequestTime(new DateTime());
        $model->generateRequestKey();

        $this->getEventManager()->trigger(__FUNCTION__, $this, [
            'record' => $model,
            'userId' => $user->getId()
        ]);

        $this->getEntityManager()->persist($model);
        $this->getEntityManager()->flush();

        $this->sendForgotEmailMessage($model, $user);
    }

    /**
     * Send user forgot password email message
     *
     * @param  PasswordEntity $model
     * @param  UserInterface  $user
     * @return boolean
     */
    public function sendForgotEmailMessage(PasswordEntity $model, UserInterface $user)
    {
        $this->getMailer()->sendForgotEmailMessage($model, $user);
    }

    /**
     * Reset the password
     *
     * @param  PasswordEntity $passwordEntity
     * @param  UserInterface  $user
     * @param  array          $data
     * @return boolean
     */
    public function resetPassword(PasswordEntity $passwordEntity, UserInterface $user, array $data)
    {
        $newPass = $data['newCredential'];

        $bcrypt = new Bcrypt();
        $bcrypt->setCost($this->getZfcUserOptions()->getPasswordCost());
        $pass = $bcrypt->create($newPass);
        $user->setPassword($pass);

        $this->getEventManager()->trigger(__FUNCTION__, $this, ['user' => $user]);

        $this->getEntityManager()->remove($passwordEntity);
        $this->getEntityManager()->flush();

        $this->getEventManager()->trigger(__FUNCTION__.'.post', $this, ['user' => $user]);

        return true;
    }

    /**
     * Get zfc user options
     *
     * @return ZfcUserOptions
     */
    public function getZfcUserOptions()
    {
        return $this->zfcUserOptions;
    }

    /**
     * Set zfc user options
     *
     * @param  ZfcUserOptions $zfcUserOptions
     * @return Password
     */
    public function setZfcUserOptions(ZfcUserOptions $zfcUserOptions)
    {
        $this->zfcUserOptions = $zfcUserOptions;

        return $this;
    }
}
