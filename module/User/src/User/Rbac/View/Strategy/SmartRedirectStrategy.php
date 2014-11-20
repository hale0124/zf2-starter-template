<?php

namespace User\Rbac\View\Strategy;

use Zend\Authentication\AuthenticationService;
use Zend\Mvc\MvcEvent;
use ZfcRbac\View\Strategy\AbstractStrategy;

/**
 * Smart redirect strategy
 */
class SmartRedirectStrategy extends AbstractStrategy
{
    /**
     * @var AuthenticationService
     */
    protected $authenticationService;

    /**
     * Constructor
     *
     * @param AuthenticationService $authenticationService
     */
    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    /**
     * If user is logged in, it calls UnauthorizedStrategy otherwise it calls RedirectStrategy
     *
     * @param  MvcEvent $event
     * @return void
     */
    public function onError(MvcEvent $event)
    {
        $app = $event->getApplication();
        $serviceManager = $app->getServiceManager();

        if ($this->authenticationService->hasIdentity()) {
            $serviceManager->get('ZfcRbac\View\Strategy\UnauthorizedStrategy')->onError($event);
        } else {
            $serviceManager->get('ZfcRbac\View\Strategy\RedirectStrategy')->onError($event);
        }
    }
}
