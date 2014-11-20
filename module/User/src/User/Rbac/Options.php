<?php

namespace User\Rbac;

use Zend\Stdlib\AbstractOptions;

/**
 * Rbac options class
 */
class Options extends AbstractOptions
{
    /**
     * @var string
     */
    protected $defaultGuestRole = 'guest';

    /**
     * @var string
     */
    protected $defaultUserRole = 'member';

    /**
     * Get default guest role
     *
     * @return string
     */
    public function getDefaultGuestRole()
    {
        return $this->defaultGuestRole;
    }

    /**
     * Set default guest role
     *
     * @param  string  $defaultGuestRole
     * @return Options
     */
    public function setDefaultGuestRole($defaultGuestRole)
    {
        $this->defaultGuestRole = $defaultGuestRole;

        return $this;
    }

    /**
     * Get default user role
     *
     * @return string
     */
    public function getDefaultUserRole()
    {
        return $this->defaultUserRole;
    }

    /**
     * Set default user role
     *
     * @param  string  $defaultUserRole
     * @return Options
     */
    public function setDefaultUserRole($defaultUserRole)
    {
        $this->defaultUserRole = $defaultUserRole;

        return $this;
    }
}
