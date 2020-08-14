<?php

namespace App\EBP\Repositories\Users;

use App\EBP\Entities\Role;
use App\EBP\Entities\User;
use App\EBP\Repositories\BaseRepository;

/**
 * Class RolesRepository
 * @package App\Repositories\Users
 */
class RolesRepository extends BaseRepository implements IRolesRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Role::class;
    }

    /**
     * Get User Role Id By Name
     *
     * @param string $name
     * @return Role
     */
    public function getRoleByName(string $name)
    {
        return $this->model->where('name', $name)->firstOrFail();
    }
}
