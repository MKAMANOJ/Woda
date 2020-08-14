<?php

namespace App\Domain\Admin\Services;

use App\EBP\Repositories\Users\IUsersRepository;
use App\EBP\Entities\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Psr\Log\LoggerInterface;

/**
 * Class UsersService
 * @package App\Services
 */
class UsersService
{
    /**
     * @var LoggerInterface
     */
    protected $logger;
    /**
     * @var UserDetail
     */
    protected $user;
    /**
     * @var UserDetail
     */
    protected $userDetail;
    /**
     * @var IUsersRepository
     */
    protected $usersRepository;

    /**
     * UsersService constructor.
     * @param IUsersRepository $usersRepository
     * @param LoggerInterface  $logger
     * @param User             $user
     */
    public function __construct(
        IUsersRepository $usersRepository,
        LoggerInterface $logger,
        User $user
    ) {
        $this->usersRepository = $usersRepository;
        $this->logger          = $logger;
        $this->user            = $user;
    }

    /**
     * Returns all the users.
     * @return mixed
     */
    public function allUsers(): Collection
    {
        return $this->usersRepository->getAll();
    }

    /**
     * Returns all the users with admin privilege.
     * @return mixed
     */
    public function getAllAdminUsers(): Collection
    {
        $adminRoles = array_keys(getAdminUserRoles()->toArray());

        return $this->usersRepository->getUsersByRole($adminRoles);
    }

    /**
     * Get users by role.
     *
     * @param $role : it can be array or integer
     * @return mixed
     */
    public function getByRole($role)
    {
        return $this->usersRepository->getUsersByRole($role);
    }


    /**
     * Create a new user
     *
     * @param array $inputData
     * @param int   $roleId
     */
    public function createUser(array $inputData, int $roleId)
    {
        $user = $this->usersRepository->create($inputData);
        $user->roles()->sync([$roleId]);
    }

    /**
     * Returns the user with the id provided.
     *
     * @param int $userId
     * @return
     */
    public function getById(int $userId)
    {
        return $this->usersRepository->find($userId);
    }

    /**
     * Update User based upon the update data.
     *
     * @param       $user
     * @param array $inputData
     * @param       $role
     * @return bool
     */
    public function update($user, array $inputData, $role)
    {
        $this->usersRepository->update($inputData, $user->id);
        $user->roles()->sync($role);
    }

    /**
     *  Delete the user.
     *
     * @param $user
     * @return bool|mixed
     */
    public function deleteUser(User $user)
    {
        $this->usersRepository->delete($user->id);
    }


    /**
     * Get users by role
     * @param array $roles
     * @return mixed
     * @internal param int $roleId
     */
    public function getUsersByRole(array $roles)
    {
        return $this->usersRepository->getUsersByRole($roles);
    }

    /**
     * count users
     *
     * @return mixed
     */
    public function getCount()
    {
        return $this->usersRepository->count();
    }


    /**
     * Activates user.
     * @param string $email
     * @param string $token
     * @return bool
     */
    public function activate(string $email, string $token): bool
    {
        return $this->usersRepository->activate($email, $token);
    }

    /**
     * Activates and sets password.
     * @param $inputData
     * @param $token
     * @return string
     */
    public function activateAndSetPassword(array $inputData, string $token): bool
    {
        return $this->usersRepository->setPassword($inputData, $token);
    }
}
