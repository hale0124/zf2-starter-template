<?php

namespace User\Entity;

/**
 * User password reset entity class
 */
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use ZfcUser\Entity\UserInterface;

/**
 * @ORM\Entity(repositoryClass="User\Entity\Repository\Password")
 * @ORM\Table(name="user_password_reset")
 */
class Password
{
    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(name="request_key", type="string", length=32)
     */
    protected $requestKey;

    /**
     * @var UserInterface
     *
     * @ORM\OneToOne(targetEntity="User\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id", onDelete="CASCADE")
     */
    protected $user;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="request_time", type="datetime")
     */
    protected $requestTime;

    /**
     * Get request key
     *
     * @return string
     */
    public function getRequestKey()
    {
        return $this->requestKey;
    }

    /**
     * Set request key
     *
     * @param  string   $requestKey
     * @return Password
     */
    public function setRequestKey($requestKey)
    {
        $this->requestKey = $requestKey;

        return $this;
    }

    /**
     * Generate a new request key based on user id
     */
    public function generateRequestKey()
    {
        $this->setRequestKey(strtoupper(substr(sha1(
            $this->getUser()->getId().
            '####'.
            $this->getRequestTime()->getTimestamp()
        ), 0, 15)));
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
     * @return Password
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get request time
     *
     * @return DateTime
     */
    public function getRequestTime()
    {
        if (!$this->requestTime instanceof DateTime) {
            $this->requestTime = new DateTime('now');
        }

        return $this->requestTime;
    }

    /**
     * Set request time
     *
     * @param  integer|DateTime $time
     * @return Password
     */
    public function setRequestTime($time)
    {
        if (!$time instanceof DateTime) {
            $time = new DateTime($time);
        }

        $this->requestTime = $time;

        return $this;
    }

    /**
     * Validate if request has expired
     *
     * @param  integer $resetExpire
     * @return boolean
     */
    public function validateExpired($resetExpire)
    {
        $expiryDate = new \DateTime($resetExpire.' seconds ago');

        return $this->getRequestTime() < $expiryDate;
    }
}
