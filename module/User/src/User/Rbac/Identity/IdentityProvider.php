<?php

namespace User\Rbac\Identity;

use ZfcRbac\Identity\IdentityProviderInterface;

/**
 * ZfcRbac identity provider
 */
class IdentityProvider implements
    IdentityProviderInterface
{
    /**
     * @var IdentityRoleProvider
     */
    protected $identityRoleProvider;

    /**
     * Constructor
     *
     * @param IdentityRoleProvider $identityRoleProvider
     */
    public function __construct(IdentityRoleProvider $identityRoleProvider)
    {
        $this->identityRoleProvider = $identityRoleProvider;
    }

    /**
     * {@inheritDoc}
     */
    public function getIdentity()
    {
        return $this->identityRoleProvider;
    }
}
