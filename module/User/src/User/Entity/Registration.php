<?php

namespace User\Entity;

/**
 * User registration entity class
 */
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Zend\Math\Rand;
use ZfcUser\Entity\UserInterface;

/**
 * @ORM\Entity(repositoryClass="User\Entity\Repository\Registration")
 * @ORM\Table(name="user_registration")
 */
class Registration
{
    /**
     * Length of the request key
     *
     * @var integer
     */
    const REQUEST_KEY_LENGTH = 16;

    /**
     * @var UserInterface
     *
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="User\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id", onDelete="CASCADE")
     */
    protected $user;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=16, unique=true)
     */
    protected $token;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="request_time", type="datetime")
     */
    protected $requestTime;

    /**
     * @var boolean
     *
     * @ORM\Column(name="responded", type="boolean")
     */
    protected $responded = false;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    protected $created;

    /**
     * Constructor
     *
     * @param UserInterface $user
     */
    public function __construct(UserInterface $user = null)
    {
        $this->setRequestTime(new DateTime());

        if ($user) {
            $this->setUser($user);
        }
    }

    /**
     * Get user
     *
     * @return type
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set user
     *
     * @param  UserInterface $user
     * @return Registration
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;

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
     * @param  string       $token
     * @return Registration
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Generate new token
     *
     * @return Registration
     */
    public function generateToken()
    {
        $this->setToken(Rand::getString(
            static::REQUEST_KEY_LENGTH,
            'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',
            true
        ));

        return $this;
    }

    /**
     * Get request time
     *
     * @return type
     */
    public function getRequestTime()
    {
        return $this->requestTime;
    }

    /**
     * Set request time
     *
     * @param  DateTime     $requestTime
     * @return Registration
     */
    public function setRequestTime(DateTime $requestTime)
    {
        $this->requestTime = $requestTime;

        return $this;
    }

    /**
     * Get responded
     *
     * @return boolean
     */
    public function getResponded()
    {
        return $this->responded;
    }

    /**
     * Set responded
     *
     * @param  boolean      $responded
     * @return Registration
     */
    public function setResponded($responded)
    {
        $this->responded = $responded;

        return $this;
    }

    /**
     * Get created
     *
     * @return DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set created
     *
     * @param  DateTime     $created
     * @return Registration
     */
    public function setCreated(DateTime $created)
    {
        $this->created = $created;

        return $this;
    }
}
