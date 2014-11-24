<?php

namespace Base\Entity;

/**
 * Country entity class
 */
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Base\Entity\Repository\Country")
 * @ORM\Table(name="geo_country")
 */
class Country
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="country_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="country_name", type="string")
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="FIPS104", type="string", length=2, nullable=true)
     */
    protected $fips104;

    /**
     * @var string
     *
     * @ORM\Column(name="ISO2", type="string", length=2, nullable=true)
     */
    protected $iso2;

    /**
     * @var string
     *
     * @ORM\Column(name="ISO3", type="string", length=3, nullable=true)
     */
    protected $iso3;

    /**
     * @var integer
     *
     * @ORM\Column(name="ISON", type="string", nullable=true)
     */
    protected $ison;

    /**
     * @var string
     *
     * @ORM\Column(name="internet", type="string", nullable=true)
     */
    protected $internet;

    /**
     * @var string
     *
     * @ORM\Column(name="capital_city", type="string", nullable=true)
     */
    protected $capital;

    /**
     * @var string
     *
     * @ORM\Column(name="map_reference", type="string", nullable=true)
     */
    protected $mapReference;

    /**
     * @var string
     *
     * @ORM\Column(name="nationality_singular", type="string", nullable=true)
     */
    protected $nationalitySingular;

    /**
     * @var string
     *
     * @ORM\Column(name="nationality_plural", type="string", nullable=true)
     */
    protected $nationalityPlural;

    /**
     * @var string
     *
     * @ORM\Column(name="currency", type="string", nullable=true)
     */
    protected $currency;

    /**
     * @var string
     *
     * @ORM\Column(name="currency_code", type="string", length=3, nullable=true)
     */
    protected $currencyCode;

    /**
     * @var integer
     *
     * @ORM\Column(name="population", type="string", nullable=true)
     */
    protected $population;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", nullable=true)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", nullable=true)
     */
    protected $comment;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Base\Entity\Province", mappedBy="country")
     */
    protected $provinces;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Base\Entity\City", mappedBy="country")
     */
    protected $cities;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->provinces = new ArrayCollection();
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
     * @param  integer $id
     * @return Country
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
     * @param  string  $name
     * @return Country
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get FIPS104
     *
     * @return string
     */
    public function getFips104()
    {
        return $this->fips104;
    }

    /**
     * Set FIPS104
     *
     * @param  string  $fips104
     * @return Country
     */
    public function setFips104($fips104)
    {
        $this->fips104 = $fips104;

        return $this;
    }

    /**
     * Get ISO2
     *
     * @return string
     */
    public function getIso2()
    {
        return $this->iso2;
    }

    /**
     * Set ISO2
     *
     * @param  string  $iso2
     * @return Country
     */
    public function setIso2($iso2)
    {
        $this->iso2 = $iso2;

        return $this;
    }

    /**
     * Get ISO3
     *
     * @return string
     */
    public function getIso3()
    {
        return $this->iso3;
    }

    /**
     * Set ISO3
     *
     * @param  string  $iso3
     * @return Country
     */
    public function setIso3($iso3)
    {
        $this->iso3 = $iso3;

        return $this;
    }

    /**
     * Get ISON
     *
     * @return integer
     */
    public function getIson()
    {
        return $this->ison;
    }

    /**
     * Set ISON
     *
     * @param  integer $ison
     * @return Country
     */
    public function setIson($ison)
    {
        $this->ison = $ison;

        return $this;
    }

    /**
     * Get internet
     *
     * @return string
     */
    public function getInternet()
    {
        return $this->internet;
    }

    /**
     * Set internet
     *
     * @param  string  $internet
     * @return Country
     */
    public function setInternet($internet)
    {
        $this->internet = $internet;

        return $this;
    }

    /**
     * Get capital
     *
     * @return string
     */
    public function getCapital()
    {
        return $this->capital;
    }

    /**
     * Set capital
     *
     * @param  string  $capital
     * @return Country
     */
    public function setCapital($capital)
    {
        $this->capital = $capital;

        return $this;
    }

    /**
     * Get map reference
     *
     * @return string
     */
    public function getMapReference()
    {
        return $this->mapReference;
    }

    /**
     * Set map reference
     *
     * @param  string  $mapReference
     * @return Country
     */
    public function setMapReference($mapReference)
    {
        $this->mapReference = $mapReference;

        return $this;
    }

    /**
     * Get nationality singular
     *
     * @return string
     */
    public function getNationalitySingular()
    {
        return $this->nationalitySingular;
    }

    /**
     * Set nationality singular
     *
     * @param  string  $nationalitySingular
     * @return Country
     */
    public function setNationalitySingular($nationalitySingular)
    {
        $this->nationalitySingular = $nationalitySingular;

        return $this;
    }

    /**
     * Get nationality plural
     *
     * @return string
     */
    public function getNationalityPlural()
    {
        return $this->nationalityPlural;
    }

    /**
     * Set nationality plural
     *
     * @param  string  $nationalityPlural
     * @return Country
     */
    public function setNationalityPlural($nationalityPlural)
    {
        $this->nationalityPlural = $nationalityPlural;

        return $this;
    }

    /**
     * Get currency
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set currency
     *
     * @param  string  $currency
     * @return Country
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency code
     *
     * @return string
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    /**
     * Set currency code
     *
     * @param  string  $currencyCode
     * @return Country
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;

        return $this;
    }

    /**
     * Get population
     *
     * @return integer
     */
    public function getPopulation()
    {
        return $this->population;
    }

    /**
     * Set population
     *
     * @param  integer $population
     * @return Country
     */
    public function setPopulation($population)
    {
        $this->population = $population;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param  string  $title
     * @return Country
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set comment
     *
     * @param  string  $comment
     * @return Country
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get provinces
     *
     * @return ArrayCollection
     */
    public function getProvinces()
    {
        return $this->provinces;
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
}
