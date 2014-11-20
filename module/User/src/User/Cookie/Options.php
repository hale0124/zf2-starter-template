<?php

namespace User\Cookie;

/**
 * User cookie options class
 */
use Zend\Stdlib\AbstractOptions;

class Options extends AbstractOptions
{
    /**
     * Turn off strict options mode
     */
    protected $__strictMode__ = false;

    /**
     * @var int
     */
    protected $cookieExpire = 2592000;

    /**
     * @var string
     */
    protected $cookieDomain = null;

    /**
     * @var string
     */
    protected $cookieEntityClass = 'User\Entity\Cookie';

    /**
     * Get cookie expire
     *
     * @return integer
     */
    public function getCookieExpire()
    {
        return $this->cookieExpire;
    }

    /**
     * Set cookie expire
     *
     * @param  integer $cookieExpire
     * @return Options
     */
    public function setCookieExpire($cookieExpire)
    {
        $this->cookieExpire = $cookieExpire;

        return $this;
    }

    /**
     * Get cookie domain
     *
     * @return string
     */
    public function getCookieDomain()
    {
        return $this->cookieDomain;
    }

    /**
     * Set cookie domain
     *
     * @param  string  $cookieDomain
     * @return Options
     */
    public function setCookieDomain($cookieDomain)
    {
        $this->cookieDomain = $cookieDomain;

        return $this;
    }

    /**
     * Get cookie entity class
     *
     * @return string
     */
    public function getCookieEntityClass()
    {
        return $this->cookieEntityClass;
    }

    /**
     * Set cookie entity class
     *
     * @param  string  $cookieEntityClass
     * @return Options
     */
    public function setCookieEntityClass($cookieEntityClass)
    {
        $this->cookieEntityClass = $cookieEntityClass;

        return $this;
    }
}
