<?php

namespace User\Authentication\Adapter;

use Zend\Authentication\Result as AuthenticationResult;
use Doctrine\ORM\EntityManager;
use ZfcUser\Authentication\Adapter\AbstractAdapter;
use ZfcUser\Authentication\Adapter\AdapterChainEvent;
use Base\Traits\EntityManagerAwareTrait;

/**
 * Email verification authentication adapter
 */
class EmailVerification extends AbstractAdapter
{
    use EntityManagerAwareTrait;

    /**
     * Constructor
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->setEntityManager($entityManager);
    }

    /**
     * {@inheritDoc}
     */
    public function authenticate(AdapterChainEvent $e)
    {
        if ($e->getIdentity()) {
            $user = $this->getEntityManager()->find('User\Entity\User', $e->getIdentity());
            $registrationRecord = $this->getEntityManager()->getRepository('User\Entity\Registration')
                ->findOneByUser($user);

            if (!$registrationRecord || !$registrationRecord->getResponded()) {
                $e->setCode(AuthenticationResult::FAILURE)
                    ->setMessages(['Email Address not verified yet']);

                return false;
            }

            return true;
        }

        return false;
    }
}
