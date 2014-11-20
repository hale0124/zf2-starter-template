<?php

namespace Application\Controller\Factory;

use Zend\Http\Client;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use DoctrineORMModule\Yuml\YumlController;

class YumlControllerFactory implements
    FactoryInterface
{
    /**
     * Fix for the Doctrine 2 Yuml Controller
     * @todo Remove once they fix this
     *
     * @param  \Zend\ServiceManager\ServiceLocatorInterface $controllers
     * @return \DoctrineORMModule\Yuml\YumlController
     * @throws ServiceNotFoundException
     */
    public function createService(ServiceLocatorInterface $controllers)
    {
        $config = $controllers->getServiceLocator()->get('Config');

        if (! isset($config['zenddevelopertools']['toolbar']['enabled'])
            || !$config['zenddevelopertools']['toolbar']['enabled']
        ) {
            throw new ServiceNotFoundException(
                'Service DoctrineORMModule\\Yuml\\YumlController could not be found'
            );
        }

        return new YumlController(
            new Client('http://yuml.me/diagram/plain/class/', array('timeout' => 30))
        );
    }
}
