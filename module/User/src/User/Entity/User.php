<?php

namespace User\Entity;

/**
 * User entity class
 */
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use ZfcUser\Entity\UserInterface;

/**
 * @ORM\Entity(repositoryClass="User\Entity\Repository\User")
 * @ORM\Table(name="user")
 *
 * @Gedmo\Loggable(logEntryClass="Base\Entity\LogEntry")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=true)
 */
class User implements
    UserInterface
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="user_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     * @Gedmo\Versioned
     */
    protected $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", unique=true, length=255)
     * @Gedmo\Versioned
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="display_name", type="string", length=100)
     * @Gedmo\Versioned
     */
    protected $displayName;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=128)
     * @Gedmo\Versioned
     */
    protected $password;

    /**
     * @var int
     *
     * @ORM\Column(name="state", type="integer", nullable=true)
     * @Gedmo\Versioned
     */
    protected $state = 0;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="User\Entity\Group", inversedBy="users")
     * @ORM\JoinTable(
     *  name="users_groups",
     *  joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="user_id")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="group_id")}
     * )
     */
    protected $groups;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="last_login", type="datetime", nullable=true)
     */
    protected $lastLogin;

    /**
     * @var string
     *
     * @ORM\Column(name="last_ip_address", type="string", length=15, nullable=true)
     * @Gedmo\IpTraceable(on="update")
     */
    protected $lastIpAddress;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    protected $created;

    /**
     * @var string
     *
     * @ORM\Column(name="created_by", type="string")
     * @Gedmo\Blameable(on="create")
     */
    protected $createdBy;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="update")
     */
    protected $updated;

    /**
     * @var string
     *
     * @ORM\Column(name="updated_by", type="string")
     * @Gedmo\Blameable(on="update")
     */
    protected $updatedBy;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    protected $deletedAt;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->groups = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param  integer $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set username
     *
     * @param  string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set email
     *
     * @param  string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get display name
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * Set display name
     *
     * @param  string $displayName
     * @return User
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set password
     *
     * @param  string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get state
     *
     * @return integer
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set state
     *
     * @param  integer $state
     * @return User
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get groups
     *
     * @return type
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * Add group
     *
     * @param  Group $group
     * @return type
     */
    public function addGroup(Group $group)
    {
        if ($this->groups->contains($group)) {
            return;
        }

        $this->groups->add($group);
        $group->addUser($this);
    }

    /**
     * Remove group
     *
     * @param  Group $group
     * @return type
     */
    public function removeGroup(Group $group)
    {
        if (!$this->groups->contains($group)) {
            return;
        }

        $this->groups->removeElement($group);
        $group->removeUser($this);
    }

    /**
     * Get last login
     *
     * @return DateTime
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * Set last login
     *
     * @param  DateTime $lastLogin
     * @return User
     */
    public function setLastLogin(DateTime $lastLogin)
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * Get last ip address
     *
     * @return string
     */
    public function getLastIpAddress()
    {
        return $this->lastIpAddress;
    }

    /**
     * Set last ip address
     *
     * @param  string $lastIpAddress
     * @return User
     */
    public function setLastIpAddress($lastIpAddress)
    {
        $this->lastIpAddress = $lastIpAddress;

        return $this;
    }

    /**
     * Get created date
     *
     * @return DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set created date
     *
     * @param  DateTime $created
     * @return User
     */
    public function setCreated(DateTime $created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created by
     *
     * @return string
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set created by
     *
     * @param  string $createdBy
     * @return User
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get updated date
     *
     * @return DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set updated date
     *
     * @param  DateTime $updated
     * @return User
     */
    public function setUpdated(DateTime $updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated by
     *
     * @return type
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * Set updated by
     *
     * @param  string $updatedBy
     * @return User
     */
    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * Get deleted date
     *
     * @return DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Set deleted date
     *
     * @param  DateTime $deletedAt
     * @return User
     */
    public function setDeletedAt(DateTime $deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }
}
