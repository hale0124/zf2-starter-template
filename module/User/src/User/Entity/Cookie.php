<?php

namespace User\Entity;

/**
 * User cookie entity class
 */
use Doctrine\ORM\Mapping as ORM;
use ZfcUser\Entity\UserInterface;

/**
 * @ORM\Entity(repositoryClass="User\Entity\Repository\Cookie")
 * @ORM\Table(name="user_cookie")
 */
class Cookie
{
    /**
     * @var string
     *
     * @ORM\Column(name="sid", type="string", length=16, nullable=false, unique=true)
     */
    protected $sid;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=16, nullable=false)
     */
    protected $token;

    /**
     * @var \User\Entity\UserInterface
     *
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="User\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id", onDelete="CASCADE")
     */
    protected $user;

    /**
     * Get sid
     *
     * @return string
     */
    public function getSid()
    {
        return $this->sid;
    }

    /**
     * Set sid
     *
     * @param  string $sid
     * @return Cookie
     */
    public function setSid($sid)
    {
        $this->sid = $sid;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set token
     *
     * @param  string $token
     * @return Cookie
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get user
     *
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set user
     *
     * @param  UserInterface $user
     * @return Cookie
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;

        return $this;
    }
}
