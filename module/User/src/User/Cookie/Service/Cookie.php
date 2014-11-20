<?php

namespace User\Cookie\Service;

use Zend\Session\Container;
use Zend\Math\Rand;
use Doctrine\ORM\EntityManager;
use ZfcBase\EventManager\EventProvider;
use ZfcUser\Entity\UserInterface;
use Base\Traits\EntityManagerTrait;
use Base\Traits\OptionsTrait;
use User\Cookie\Options;
use User\Entity\Cookie as CookieEntity;

/**
 * User cookie service
 */

class Cookie extends EventProvider
{
    use EntityManagerTrait;
    use OptionsTrait;

    /**
     * Constructor
     *
     * @param EntityManager $entityManager
     * @param Options       $options
     */
    public function __construct(
        EntityManager $entityManager,
        Options $options
    ) {
        $this->setEntityManager($entityManager);
        $this->setOptions($options);
    }

    /**
     * Create a token
     *
     * @param  integer $length
     * @return string
     */
    public function createToken($length = 16)
    {
        $rand = Rand::getString((int) $length, null, true);

        return $rand;
    }

    /**
     * Create a serie id
     *
     * @param  integer $length
     * @return string
     */
    public function createSerieId($length = 16)
    {
        $rand = Rand::getString((int) $length, null, true);

        return $rand;
    }

    /**
     * Update entity serie
     *
     * @param  CookieEntity   $entity
     * @return string|boolean
     */
    public function updateSerie(CookieEntity $entity)
    {
        $cookie = $this->getEntityManager()
            ->getRepository($this->getOptions()->getCookieEntityClass())
            ->findOneBy([
                'sid' => $entity->getSid(),
                'user' => $entity->getUser(),
            ]);

        if ($cookie) {
            $token = $this->createToken();
            $cookie->setToken($token);
            $this->setCookie($cookie);

            $this->getEntityManager()->flush();

            return $token;
        }

        return false;
    }

    /**
     * Create serie
     *
     * @param  UserInterface  $user
     * @return Cookie|boolean
     */
    public function createSerie(UserInterface $user)
    {
        $token = $this->createToken();
        $serieId = $this->createSerieId();
        $class = $this->getOptions()->getCookieEntityClass();

        $cookie = new $class();
        $cookie->setUser($user);
        $cookie->setSid($serieId);
        $cookie->setToken($token);

        if ($this->setCookie($cookie)) {
            $this->getEntityManager()->persist($cookie);
            $this->getEntityManager()->flush();

            return $cookie;
        }

        return false;
    }

    /**
     * Remove serie
     *
     * @param UserInterface $user
     * @param integer       $sid
     */
    public function removeSerie(UserInterface $user, $sid)
    {
        $cookie = $this->getEntityManager()
            ->getRepository($this->getOptions()->getCookieEntityClass())
            ->findOneBy([
                'sid' => $sid,
                'user' => $user,
            ]);

        if ($cookie) {
            $this->getEntityManager()->remove($cookie);
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Remove cookie
     */
    public function removeCookie()
    {
        setcookie("remember_me", "", time() - 3600, '/');
    }

    /**
     * Get cookie via static method
     */
    public static function getCookie()
    {
        return isset($_COOKIE['remember_me']) ? $_COOKIE['remember_me'] : false;
    }

    /**
     * Set cookie
     *
     * @param CookieEntity $entity
     */
    public function setCookie(CookieEntity $entity)
    {
        $cookieLength = $this->getOptions()->getCookieExpire();
        $cookieDomain = $this->getOptions()->getCookieDomain();
        $cookieValue = $entity->getUser()->getId()."\n".$entity->getSid()."\n".$entity->getToken();

        return setcookie("remember_me", $cookieValue, time() + $cookieLength, '/', $cookieDomain, null, true);
    }

    /**
     * Check whether the current login is done via cookie
     * Should be performed before allowing to change PW, access Financial Information etc.
     *
     * @return Boolean
     */
    public function isCookieLogin()
    {
        $session = new Container('zfcuser');

        return $session->offsetGet("cookieLogin");
    }
}
