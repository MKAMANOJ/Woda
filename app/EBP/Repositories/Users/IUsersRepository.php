<?php

namespace App\EBP\Repositories\Users;


/**
 * Interface UsersRepositoryInterface
 * @package App\Repositories\Users
 */
interface IUsersRepository
{

    /**
     * Get user by role.
     *
     * @param array $userRoles : may be int or array.
     * @return mixed
     */
    public function getUsersByRole($userRoles, $dataTable = false);


    /**
     * Returns all the client users to display in the data table.
     * @return mixed
     */
    public function getAllClientsForDataTable();

    /**
     * Get all finder for data table
     *
     * @return mixed
     */
    public function getAllFinderForDataTable();

    /**
     * Get all filler for data table
     *
     * @return mixed
     */
    public function getAllFillerForDataTable();

    /**
     * Get all filler
     *
     * @return mixed
     */
    public function getAllFiller();

    /**
     * @return mixed
     */
    public function getAllFinder();

    /**
     * get filler by id
     *
     * @param int $id
     * @return mixed
     */
    public function getFillerById(int $id);

    /**
     * Get finder by id
     *
     * @param int $id
     * @return mixed
     */
    public function getFinderById(int $id);

    /**
     * for multiple delete
     *
     * @param array $selectedIds
     * @return mixed
     */
    public function multiDelete(array $selectedIds);

    /**
     * count users
     *
     * @return mixed
     */
    public function count();

    /**
     * Activates user.
     * @param string $email
     * @param string $token
     * @return bool
     */
    public function activate(string $email, string $token): bool;

    /**
     * Sets Password
     * @param array  $inputData
     * @param string $token
     */
    public function setPassword(array $inputData, string $token);

    /**
     * Saves token for new user.
     * @param array $data
     */
    public function saveToken(array $data);
}
