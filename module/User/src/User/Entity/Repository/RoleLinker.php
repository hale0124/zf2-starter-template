<?php

namespace User\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use ZfcUser\Entity\UserInterface;

/**
 * Role linker repository
 */
class RoleLinker extends EntityRepository
{
    /**
     * Finds roles by user
     *
     * @param UserInterface $user
     */
    public function findByUser(UserInterface $user)
    {
        return $this->findByUserId($user->getId());
    }

    /**
     * Find users by role id
     *
     * @param string $roleId
     */
    public function findUsersByRoleId($roleId)
    {
        $dql  = 'SELECT a FROM User\Entity\User a ';
        $dql .= 'JOIN User\Entity\RoleLinker b WITH a.id = b.userId ';
        $dql .= 'WHERE b.roleId = :roleid ';
        $dql .= 'GROUP BY a.id ';

        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter(':roleid', $roleId);

        return $query->getResult();
    }
}
