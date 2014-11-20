<?php

namespace User\Authentication\Adapter;

use Zend\Authentication\Result as AuthenticationResult;
use Zend\Session\Container;
use Doctrine\ORM\EntityManager;
use ZfcUser\Authentication\Adapter\AbstractAdapter;
use ZfcUser\Authentication\Adapter\AdapterChainEvent as AuthEvent;
use Base\Traits\EntityManagerTrait;
use Base\Traits\OptionsTrait;
use User\Cookie\Options;
use User\Cookie\Service\Cookie as CookieService;

/**
 * Cookie authentication adapter
 */
class Cookie extends AbstractAdapter
{
    use EntityManagerTrait;
    use OptionsTrait;

    /**
     * @var Cookie
     */
    protected $cookieService;

    /**
     * Constructor
     *
     * @param EntityManager $entityManager
     * @param CookieService $cookieService
     * @param Options       $options
     */
    public function __construct(
        EntityManager $entityManager,
        CookieService $cookieService,
        Options $options
    ) {
        $this->setEntityManager($entityManager);
        $this->setCookieService($cookieService);
        $this->setOptions($options);
    }

    /**
     * {@inheritDoc}
     */
    public function authenticate(AuthEvent $e)
    {
        // check if cookie needs to be set, only when prior auth has been successful
        if (
            $e->getIdentity() !== null &&
            $e->getRequest()->isPost() &&
            array_key_exists('remember_me', $e->getRequest()->getPost())
        ) {
            $user = $this->getEntityManager()->find('User\Entity\User', $e->getIdentity());

            // remove already set cookies
            $rememberMe = $this->getEntityManager()
                ->getRepository($this->getOptions()->getCookieEntityClass())
                ->findOneByUser($user);

            if ($rememberMe) {
                $this->getCookieService()->removeCookie();

                $this->getEntityManager()->remove($rememberMe);
                $this->getEntityManager()->flush();
            }

            $this->getCookieService()->createSerie($user);

            /**
            * If the user has first logged in with a cookie,
            * but afterwords login with identity/credential
            * we remove the "cookieLogin" session.
            */
            $session = new Container('zfcuser');
            $session->offsetSet("cookieLogin", false);

            return;
        }

        if ($this->isSatisfied()) {
            $storage = $this->getStorage()->read();
            $e->setIdentity($storage['identity'])->setCode(AuthenticationResult::SUCCESS)
                ->setMessages(array('Authentication successful.'));

            return;
        }

        $cookies = $e->getRequest()->getCookie();

        // no cookie present, skip authentication
        if (!isset($cookies['remember_me'])) {
            return false;
        }

        $cookie = explode("\n", $cookies['remember_me']);
        $cookieUser = $this->getEntityManager()->find('User\Entity\User', $cookie[0]);

        $rememberMe = $this->getEntityManager()
            ->getRepository($this->getOptions()->getCookieEntityClass())
            ->findOneBy([
                'user' => $cookieUser,
                'sid' => $cookie[1],
            ]);

        if (!$rememberMe) {
            $this->getCookieService()->removeCookie();

            return false;
        }

        if ($rememberMe->getToken() !== $cookie[2]) {
            $entities = $this->getEntityManager()
                ->getRepository($this->getOptions()->getCookieEntityClass())
                ->findByUser($user);

            foreach ($entities as $entity) {
                $this->getEntityManager()->remove($entity);
            }

            $this->getCookieService()->removeCookie();
            $this->setSatisfied(false);
            $e->setCode(AuthenticationResult::FAILURE)
                ->setMessages(array('Possible identity theft detected.'));

            $this->getEntityManager()->flush();

            return false;
        }

        $this->getCookieService()->updateSerie($rememberMe);

        $e->setIdentity($cookieUser->getId());
        $this->setSatisfied(true);

        $storage = $this->getStorage()->read();
        $storage['identity'] = $e->getIdentity();
        $this->getStorage()->write($storage);

        $e->setCode(AuthenticationResult::SUCCESS)
          ->setMessages(array('Authentication successful.'));

        $session = new Container('zfcuser');
        $session->offsetSet("cookieLogin", true);
    }

    /**
     * Get cookie service
     *
     * @return CookieService
     */
    public function getCookieService()
    {
        return $this->cookieService;
    }

    /**
     * Set cookie service
     *
     * @param  CookieService $cookieService
     * @return Cookie
     */
    public function setCookieService(CookieService $cookieService)
    {
        $this->cookieService = $cookieService;

        return $this;
    }
}
