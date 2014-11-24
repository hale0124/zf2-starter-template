<?php

namespace Base\Entity;

/**
 * Province entity class
 */
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Base\Entity\Repository\City")
 * @ORM\Table(name="geo_city")
 */
class City
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="city_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="city_name", type="string")
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=10, nullable=true)
     */
    protected $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=10, nullable=true)
     */
    protected $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="timezone", type="string", length=10, nullable=true)
     */
    protected $timeZone;

    /**
     * @var string
     *
     * @ORM\Column(name="dma_id", type="string", nullable=true)
     */
    protected $dmaId;

    /**
     * @var string
     *
     * @ORM\Column(name="country_code", type="string", length=4, nullable=true)
     */
    protected $code;

    /**
     * @var Country
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Country", inversedBy="cities")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="country_id")
     */
    protected $country;

    /**
     * @var Province
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Province", inversedBy="cities")
     * @ORM\JoinColumn(name="province_id", referencedColumnName="province_id")
     */
    protected $province;

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
     * @return City
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
     * @param  string $name
     * @return City
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set latitude
     *
     * @param  string $latitude
     * @return City
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set longitude
     *
     * @param  string $longitude
     * @return City
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get timeZone
     *
     * @return string
     */
    public function getTimeZone()
    {
        return $this->timeZone;
    }

    /**
     * Set timeZone
     *
     * @param  string $timeZone
     * @return City
     */
    public function setTimeZone($timeZone)
    {
        $this->timeZone = $timeZone;

        return $this;
    }

    /**
     * Get DmaId
     *
     * @return string
     */
    public function getDmaId()
    {
        return $this->dmaId;
    }

    /**
     * Set DmaId
     *
     * @param  string $dmaId
     * @return City
     */
    public function setDmaId($dmaId)
    {
        $this->dmaId = $dmaId;

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
     * @param  string $code
     * @return City
     */
    public function setCode($code)
    {
        $this->code = $code;

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
     * Get province
     *
     * @return Province
     */
    public function getProvince()
    {
        return $this->province;
    }
}
