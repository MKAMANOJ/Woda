<?php

namespace App\EBP\Repositories\Users;

/**
 * Interface RolesRepositoryInterface
 * @package App\Repositories\Users
 */
interface IRolesRepository
{

    /**
     * Get User Role Id By Name
     *
     * @param string $finder
     * @return Role
     */
    public function getRoleByName(string $finder);
}
