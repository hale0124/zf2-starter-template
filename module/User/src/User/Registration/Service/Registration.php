<?php

namespace User\Registration\Service;

use DateTime;
use Zend\Crypt\Password\Bcrypt;
use Zend\EventManager\EventInterface;
use Doctrine\ORM\EntityManager;
use ZfcBase\EventManager\EventProvider;
use ZfcUser\Entity\UserInterface;
use ZfcUser\Options\ModuleOptions as ZfcUserOptions;
use Base\Interfaces\MailServiceAwareInterface;
use Base\Traits\EntityManagerAwareTrait;
use Base\Traits\MailerAwareTrait;
use Base\Traits\OptionsAwareTrait;
use User\Entity\Registration as RegistrationEntity;
use User\Registration\Options;

/**
 * User registration service
 */
class Registration extends EventProvider
{
    use EntityManagerAwareTrait;
    use MailerAwareTrait;
    use OptionsAwareTrait;

    /**
     * @var ZfcUserOptions
     */
    protected $zfcUserOptions;

    /**
     * Constructor
     *
     * @param EntityManager             $entityManager
     * @param MailServiceAwareInterface $mailer
     * @param Options                   $options
     * @param ZfcUserOptions            $zfcUserOptions
     */
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
     * On user registration
     *
     * @param EventInterface $e
     */
    public function onUserRegistration(EventInterface $e)
    {
        $user = $e->getParam('user');

        if (
            $this->getOptions()->getSendVerificationEmail() &&
            $this->getZfcUserOptions()->getEnableRegistration()
        ) {
            $this->sendVerificationEmail($user);
        } elseif (
            $this->getOptions()->getSendPasswordRequestEmail() &&
            !$this->getZfcUserOptions()->getEnableRegistration()
        ) {
            $this->sendPasswordRequestEmail($user);
        }
    }

    /**
     * Send the verification email
     *
     * @param UserInterface $user
     */
    public function sendVerificationEmail(UserInterface $user)
    {
        $registrationRecord = $this->createRegistrationRecord($user);
        $this->getMailer()->sendVerificationEmail($registrationRecord);
    }

    /**
     * Send the password request email
     *
     * @param UserInterface $user
     */
    public function sendPasswordRequestEmail(UserInterface $user)
    {
        $registrationRecord = $this->createRegistrationRecord($user);
        $this->getMailer()->sendPasswordRequestEmail($registrationRecord);
    }

    /**
     * Create a new registration record
     *
     * @param  UserInterface $user
     * @return type
     */
    protected function createRegistrationRecord(UserInterface $user)
    {
        $entityClass = $this->getOptions()->getRegistrationEntityClass();
        $entity = new $entityClass($user);

        $this->getEventManager()->trigger(__FUNCTION__, $this,
            ['user' => $user, 'record' => $entity]
        );

        $entity->generateToken();
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();

        $this->getEventManager()->trigger(__FUNCTION__.'.post', $this,
            ['user' => $user, 'record' => $entity]
        );

        return [$entity];
    }

    /**
     * Verify the email address
     *
     * @param  UserInterface $user
     * @param  string        $token
     * @return boolean
     */
    public function verifyEmail(UserInterface $user, $token)
    {
        $record = $this->getEntityManager()
            ->getRepository($this->getOptions()->getRegistrationEntityClass())
            ->findOneByUser($user);

        $this->getEventManager()->trigger(__FUNCTION__, $this,
            ['user' => $user, 'token' => $token, 'record' => $record]
        );

        if (!$record || !$this->isTokenValid($user, $token, $record)) {
            return false;
        }

        if (!$record->getResponded()) {
            $record->setResponded(true);
            $this->getEntityManager()->flush();
        }

        $this->getEventManager()->trigger(__FUNCTION__.'.post', $this,
            ['user' => $user, 'token' => $token, 'record' => $record]
        );

        return true;
    }

    /**
     * Check whether a token is valid
     *
     * @param  UserInterface $user
     * @param  string        $token
     * @param  type          $record
     * @return boolean
     */
    public function isTokenValid(UserInterface $user, $token, RegistrationEntity $record)
    {
        if ($record->getToken() !== $token) {
            $this->getEventManager()->trigger('tokenInvalid', $this,
                ['user' => $user, 'token' => $token, 'record' => $record]
            );

            return false;
        } elseif (
            $this->getOptions()->getEnableRequestExpiry() &&
            $this->isTokenExpired($record)
        ) {
            $this->getEventManager()->trigger('tokenExpired', $this,
                ['user' => $user, 'token' => $token, 'record' => $record]
            );

            return false;
        }

        $this->getEventManager()->trigger('tokenValid', $this,
            ['user' => $user, 'token' => $token, 'record' => $record]
        );

        return true;
    }

    /**
     * Check whether a token has expired
     *
     * @param  \User\Registration\Service\UserRegistrationInterface $record
     * @return boolean
     */
    public function isTokenExpired(RegistrationEntity $record)
    {
        $expiryDate = new DateTime($this->getOptions()->getRequestExpiry().' seconds ago');

        return $record->getRequestTime() < $expiryDate;
    }

    /**
     * Set user password
     *
     * @param array              $data
     * @param RegistrationEntity $registrationRecord
     */
    public function setPassword(array $data, RegistrationEntity $registrationRecord)
    {
        $newPass = $data['newCredential'];
        $user = $registrationRecord->getUser();
        $bcrypt = new Bcrypt();
        $bcrypt->setCost($this->getZfcUserOptions()->getPasswordCost());
        $pass = $bcrypt->create($newPass);
        $user->setPassword($pass);

        $this->getEventManager()->trigger(__FUNCTION__, $this,
            ['user' => $user, 'record' => $registrationRecord]
        );

        $registrationRecord->setResponded(true);
        $this->getEntityManager()->flush();

        $this->getEventManager()->trigger(__FUNCTION__.'.post', $this,
            ['user' => $user, 'record' => $registrationRecord]
        );
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
     * @return Registration
     */
    public function setZfcUserOptions(ZfcUserOptions $zfcUserOptions)
    {
        $this->zfcUserOptions = $zfcUserOptions;

        return $this;
    }
}
