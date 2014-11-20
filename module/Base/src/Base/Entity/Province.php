<?php

namespace Base\Entity;

/**
 * Province entity class
 */
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Base\Entity\Repository\Province")
 * @ORM\Table(name="geo_province")
 */
class Province
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="province_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="province_name", type="string")
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="province_code", type="string", length=2, nullable=true)
     */
    protected $code;

    /**
     * @var string
     *
     * @ORM\Column(name="ADM1Code", type="string", nullable=true)
     */
    protected $adm1Code;

    /**
     * @var Country
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Country", inversedBy="provinces")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="country_id")
     */
    protected $country;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Base\Entity\City", mappedBy="province")
     */
    protected $cities;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cities = new ArrayCollection();
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
     * @param  integer  $id
     * @return Province
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
     * @param  string   $name
     * @return Province
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set code
     *
     * @param  string   $code
     * @return Province
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get ADM1Code
     *
     * @return string
     */
    public function getAdm1Code()
    {
        return $this->adm1Code;
    }

    /**
     * Set ADM1Code
     *
     * @param  string   $adm1Code
     * @return Province
     */
    public function setAdm1Code($adm1Code)
    {
        $this->adm1Code = $adm1Code;

        return $this;
    }

    /**
     * Get country
     *
     * @return Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set country
     *
     * @param  Country  $country
     * @return Province
     */
    public function setCountry(Country $country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get cities
     *
     * @return ArrayCollection
     */
    public function getCities()
    {
        return $this->cities;
    }

    /**
     * Set cities
     *
     * @param  ArrayCollection $cities
     * @return Province
     */
    public function setCities(ArrayCollection $cities)
    {
        $this->cities = $cities;

        return $this;
    }
}
