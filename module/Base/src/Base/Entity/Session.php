<?php

namespace Base\Entity;

/**
 * Session entity class
 */
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Base\Entity\Repository\Session")
 * @ORM\Table(name="session")
 */
class Session
{
    /**
     * @var integer
     *
     * @ORM\Column(type="string", length=128)
     * @ORM\Id
     */
    protected $id = '';

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=32)
     * @ORM\Id
     */
    protected $name = '';

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $modified;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $lifetime;

    /**
     * @var string
     *
     * @ORM\Column(type="array")
     */
    protected $data;

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
     * @param  integer                     $id
     * @return \Application\Entity\Session
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param  string                      $name
     * @return \Application\Entity\Session
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get modified
     *
     * @return integer
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * Set modified
     *
     * @param  integer                     $modified
     * @return \Application\Entity\Session
     */
    public function setModified($modified)
    {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Get lifetime
     *
     * @return integer
     */
    public function getLifetime()
    {
        return $this->lifetime;
    }

    /**
     * Set lifetime
     *
     * @param  integer                     $lifetime
     * @return \Application\Entity\Session
     */
    public function setLifetime($lifetime)
    {
        $this->lifetime = $lifetime;

        return $this;
    }

    /**
     * Get data
     *
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set data
     *
     * @param  string                      $data
     * @return \Application\Entity\Session
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }
}
