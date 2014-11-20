<?php

namespace Base\Traits;

use Doctrine\ORM\EntityManager;

/**
 * Entity manager trait
 */
trait EntityManagerTrait
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * Get entity manager
     *
     * @return type
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * Set entity manager
     *
     * @param  EntityManager      $entityManager
     * @return EntityManagerTrait
     */
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;

        return $this;
    }
}
