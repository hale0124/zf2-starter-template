<?php

namespace Base;

use Zend\EventManager\EventInterface;
use Zend\Http\PhpEnvironment\RemoteAddress;
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
 * Base module
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
            $this->setExtensionParams($e);
        }
    }

    /**
     * Set the parameters required by Gedmo extensions
     *
     * @param EventInterface $e
     */
    public function setExtensionParams(EventInterface $e)
    {
        $serviceManager = $e->getApplication()->getServiceManager();
        $remote = new RemoteAddress();
        $user = 'anonymous';

        if ($serviceManager->get('zfcuser_auth_service')->hasIdentity()) {
            $user = $serviceManager->get('zfcuser_auth_service')->getIdentity();
        }

        $serviceManager->get('doctrine_extensions.blameable')->setUserValue($user);
        $serviceManager->get('doctrine_extensions.iptraceable')->setIpValue($remote->getIpAddress());
        $serviceManager->get('doctrine_extensions.loggable')->setUsername($user);

        $entityManager = $serviceManager->get('Doctrine\ORM\EntityManager');
        $entityManager->getFilters()->enable('soft-deleteable');

        if ($user !== 'anonymous') {
            $roles = $entityManager->getRepository('User\Entity\RoleLinker')->findByUser($user);

            foreach ($roles as $role) {
                if ($role->getRoleId() === 'Administrator') {
                    $entityManager->getFilters()->disable('soft-deleteable');
                }
            }
        }
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
