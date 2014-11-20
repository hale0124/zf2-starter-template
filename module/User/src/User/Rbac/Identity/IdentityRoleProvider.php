<?php

namespace User\Rbac\Identity;

use ZfcRbac\Identity\IdentityInterface;
use ZfcUser\Entity\UserInterface;
use Doctrine\ORM\EntityManager;
use Base\Traits\EntityManagerTrait;
use Base\Traits\OptionsTrait;
use User\Rbac\Options;

/**
 * Identity role provider class
 */
class IdentityRoleProvider implements
    IdentityInterface
{
    use EntityManagerTrait;
    use OptionsTrait;

    /**
     * @var UserInterface
     */
    protected $defaultIdentity;

    /**
     * Constructor
     *
     * @param Options       $options
     * @param EntityManager $entityManager
     */
    public function __construct(
        Options $options,
        EntityManager $entityManager
    ) {
        $this->setOptions($options);
        $this->setEntityManager($entityManager);
    }

    /**
     * Get roles
     *
     * @return array
     */
    public function getRoles()
    {
        return $this->getIdentityRoles();
    }

    /**
     * Get identity roles
     *
     * @param  UserInterface $user
     * @return type
     */
    public function getIdentityRoles(UserInterface $user = null)
    {
        if ($user === null) {
            $user = $this->getDefaultIdentity();

            if (!$user) {
                return (array) $this->getOptions()->getDefaultGuestRole();
            }
        }

        $resultSet = $this->getEntityManager()->getRepository('User\Entity\RoleLinker')
            ->findByUser($user);

        if (count($resultSet) > 0) {
            $roles = [];

            foreach ($resultSet as $userRoleLinker) {
                $roles[] = $userRoleLinker->getRoleId();
            }

            return $roles;
        } else {
            return (array) $this->getOptions()->getDefaultUserRole();
        }
    }

    /**
     * Get default identity
     *
     * @return UserInterface
     */
    public function getDefaultIdentity()
    {
        return $this->defaultIdentity;
    }

    /**
     * Set default identity
     *
     * @param  UserInterface        $defaultIdentity
     * @return IdentityRoleProvider
     */
    public function setDefaultIdentity(UserInterface $defaultIdentity)
    {
        $this->defaultIdentity = $defaultIdentity;

        return $this;
    }
}
