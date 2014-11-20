<?php

namespace User\Entity;

/**
 * Role linker entity class
 */
use Doctrine\ORM\Mapping as ORM;
use ZfcUser\Entity\UserInterface;

/**
 * @ORM\Entity(repositoryClass="User\Entity\Repository\RoleLinker")
 * @ORM\Table(name="user_role_linker")
 */
class RoleLinker
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="user_id", type="integer")
     */
    protected $userId;

    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(name="role_id", type="string", length=50)
     */
    protected $roleId;

    /**
     * Constructor
     *
     * @param UserInterface $user
     * @param string        $roleId
     */
    public function __construct(UserInterface $user = null, $roleId = null)
    {
        if ($user) {
            $this->setUser($user);
        }

        if ($roleId) {
            $this->setRoleId($roleId);
        }
    }

    /**
     * Get user id
     *
     * @return type
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set user id
     *
     * @param  integer    $userId
     * @return RoleLinker
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Set user
     *
     * @param  UserInterface $user
     * @return RoleLinker
     */
    public function setUser(UserInterface $user)
    {
        $this->setUserId($user->getId());

        return $this;
    }

    /**
     * Get role id
     *
     * @return type
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * Set role id
     *
     * @param  string     $roleId
     * @return RoleLinker
     */
    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;

        return $this;
    }
}
