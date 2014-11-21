<?php

namespace User\Authentication\Storage;

use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;
use ZfcUser\Authentication\Storage\Db as ZfcDb;

/**
 * Db storage adapter
 */
class Db extends ZfcDb implements
    EventManagerAwareInterface
{
    /**
     * @var EventManagerInterface
     */
    protected $eventManager;

    /**
     * {@inheritDoc}
     */
    public function write($contents)
    {
        parent::write($contents);

        $this->getEventManager()->trigger(__FUNCTION__.'.post', $this, ['user' => $this->read()]);
    }

    /**
     * Set event manager
     *
     * @param  EventManagerInterface $eventManager
     * @return Db
     */
    public function setEventManager(EventManagerInterface $eventManager)
    {
        $eventManager->addIdentifiers([get_called_class()]);
        $this->eventManager = $eventManager;

        return $this;
    }

    /**
     * Get event manager
     *
     * @return EventManagerInterface
     */
    public function getEventManager()
    {
        if (null === $this->eventManager) {
            $this->setEventManager(new EventManager());
        }

        return $this->eventManager;
    }
}
