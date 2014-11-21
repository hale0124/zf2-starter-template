<?php

namespace User;

use Zend\EventManager\EventInterface;
use Zend\Http\Request as HttpRequest;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\ModuleManager\Feature\FormElementProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;
use Zend\Stdlib\ArrayUtils;

/**
 * User module
 */
class Module implements
    AutoloaderProviderInterface,
    BootstrapListenerInterface,
    ConfigProviderInterface,
    ControllerProviderInterface,
    FormElementProviderInterface,
    ServiceProviderInterface,
    ViewHelperProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function onBootstrap(EventInterface $e)
    {
        if ($e->getRequest() instanceof HttpRequest) {
            $this->onUserRegistration($e);
            $this->authenticateViaCookie($e);
            $this->smartRedirectStrategy($e);
            $this->updateUserLastLogin($e);
        }
    }

    /**
     * Update the users last login
     *
     * @param EventInterface $e
     * @param ServiceManager $serviceManager
     */
    public function updateUserLastLogin(EventInterface $e)
    {
        $serviceManager = $e->getApplication()->getServiceManager();

        $e->getApplication()->getEventManager()->getSharedManager()->attach(
                'User\Authentication\Storage\Db',
                'write.post',
                function ($e) use ($serviceManager) {
                    $user = $e->getParam('user');
                    $user->setLastLogin(new \Datetime());
                    $serviceManager->get('Doctrine\ORM\EntityManager')->flush();
        });
    }

    /**
     * Smart redirect strategy for rbac
     *
     * @param EventInterface $e
     */
    public function smartRedirectStrategy(EventInterface $e)
    {
        $target = $e->getTarget();

        $target->getEventManager()->attach(
            $target->getServiceManager()->get('User\Rbac\View\Strategy\SmartRedirectStrategy')
        );
    }

    /**
     * Authenticate user via cookies
     *
     * @param EventInterface $e
     */
    public function authenticateViaCookie(EventInterface $e)
    {
        $serviceManager = $e->getApplication()->getServiceManager();
        $userIsLoggedIn = $serviceManager->get('zfcuser_auth_service')->hasIdentity();
        $cookie = $e->getRequest()->getCookie();

        if (!$userIsLoggedIn && isset($cookie['remember_me'])) {
            $adapter = $e->getApplication()->getServiceManager()->get('ZfcUser\Authentication\Adapter\AdapterChain');
            $adapter->prepareForAuthentication($e->getRequest());
            $authService = $e->getApplication()->getServiceManager()->get('zfcuser_auth_service');
            $authService->authenticate($adapter);
        }

        $e->getApplication()->getEventManager()->getSharedManager()->attach(
            '*',
            ['changePassword.post', 'logout'],
            function (EventInterface $e) use ($serviceManager, $cookie) {
                if (isset($cookie['remember_me'])) {
                    $cookie = explode("\n", $cookie['remember_me']);
                    $user = $serviceManager->get('zfcuser_auth_service')->getIdentity();
                    $serviceManager->get('User\Cookie\Service\Cookie')->removeSerie($user, $cookie[1]);
                    $serviceManager->get('User\Cookie\Service\Cookie')->removeCookie();
                }
        });
    }

    /**
     * On user registration event
     *
     * @param EventInterface $e
     */
    public function onUserRegistration(EventInterface $e)
    {
        $serviceManager = $e->getParam('application')->getServiceManager();
        $sharedManager = $e->getParam('application')->getEventManager()->getSharedManager();
        $sharedManager->attach('ZfcUser\Service\User', 'register.post',
            function (EventInterface $event) use ($serviceManager) {
                $userRegistrationService = $serviceManager->get('User\Registration\Service\Registration');
                $userRegistrationService->onUserRegistration($event);
        });
    }

    /**
     * {@inheritDoc}
     */
    public function getConfig()
    {
        $config = [];

        $configFiles = [
            'asset_manager.config.php',
            'module.config.php',
            'route.config.php',
        ];

        foreach ($configFiles as $configFile) {
            $config = ArrayUtils::merge($config, include __DIR__.'/../../config/'.$configFile);
        }

        return $config;
    }

    /**
     * {@inheritDoc}
     */
    public function getServiceConfig()
    {
        return include __DIR__.'/../../config/service.config.php';
    }

    /**
     * {@inheritDoc}
     */
    public function getViewHelperConfig()
    {
        return include __DIR__.'/../../config/view_helper.config.php';
    }

    /**
     * {@inheritDoc}
     */
    public function getControllerConfig()
    {
        return include __DIR__.'/../../config/controller.config.php';
    }

    /**
     * {@inheritDoc}
     */
    public function getFormElementConfig()
    {
        return include __DIR__.'/../../config/form_element.config.php';
    }

    /**
     * {@inheritDoc}
     */
    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\ClassMapAutoloader' => [
                __DIR__.'/../../autoload_classmap.php',
            ],
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__.'/../../src/'.str_replace('\\', '/', __NAMESPACE__),
                ],
            ],
        ];
    }
}
