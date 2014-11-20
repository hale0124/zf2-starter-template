<?php

namespace User\Entity\Repository;

use DateTime;
use Doctrine\ORM\EntityRepository;
use ZfcUser\Entity\UserInterface;

/**
 * Password repository
 */
class Password extends EntityRepository
{
    /**
     * Clean expired forgot password requests
     *
     * @param  integer  $expiryTime
     * @return interger
     */
    public function cleanExpiredForgotRequests($expiryTime = 86400)
    {
        $expired = new DateTime((int) $expiryTime.' seconds ago');

        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder->delete($this->getEntityName(), 'e');
        $queryBuilder->andWhere($queryBuilder->expr()->lte('e.requestTime', ':expired'));
        $queryBuilder->setParameters([':expired' => $expired]);

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * Clean prior forgot password requests by user
     *
     * @param  UserInterface $user
     * @return interger
     */
    public function cleanPriorForgotRequests(UserInterface $user)
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder->delete($this->getEntityName(), 'e');
        $queryBuilder->andWhere($queryBuilder->expr()->lte('e.user', ':user'));
        $queryBuilder->setParameters([':user' => $user]);

        return $queryBuilder->getQuery()->getResult();
    }
}
