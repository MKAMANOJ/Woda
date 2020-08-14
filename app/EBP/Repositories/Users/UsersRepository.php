<?php

namespace App\EBP\Repositories\Users;

use App\EBP\Entities\User;
use App\EBP\Repositories\BaseRepository;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Container\Container as Application;

/**
 * Class UsersRepository
 * @package App\Repositories\Users
 */
class UsersRepository extends BaseRepository implements IUsersRepository
{
    /**
     * @var DatabaseManager
     */
    protected $databaseManager;

    /**
     * UsersRepository constructor.
     * @param Application     $app
     * @param DatabaseManager $databaseManager
     */
    public function __construct(Application $app, DatabaseManager $databaseManager)
    {
        parent::__construct($app);
        $this->databaseManager = $databaseManager;
    }

    /**
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Get user by role
     *
     * @param array $roles
     * @param bool  $dataTable
     * @return User|\Illuminate\Database\Eloquent\Builder
     */
    public function getUsersByRole($roles, $dataTable = false)
    {
        if (!is_array($roles)) {
            $rolesList[0] = $roles;
        } else {
            $rolesList = $roles;
        }

        if ($dataTable) {
            return $this->model->with('roles')->whereHas('roles', function ($user) use ($rolesList) {
                $user->whereIn('id', $rolesList);
            });
        }

        return $this->model->whereHas('roles', function ($user) use ($rolesList) {
            $user->whereIn('id', $rolesList);
        })->get();

    }

    /**
     * List of all the clients for data-table. Since users table is the base table we are doing the job here.
     * @return mixed
     */
    public function getAllClientsForDataTable()
    {
        return $this->model->join('user_details', 'users.id', '=', 'user_details.user_id')
            ->whereIn('user_details.user_group', array_keys(getClientUserRoles()->toArray()));
    }

    /**
     * Returns all the customers along with  its details
     *
     * @return mixed
     */

    public function getAllFinder()
    {
        return $this->model->finder()->with(['userDetail', 'company'])->get();
    }

    /**
     * Get all finder for data table
     *
     * @return mixed
     */
    public function getAllFinderForDataTable()
    {
        return $this->model->finder()->with(['userDetail', 'company']);
    }

    /**
     * Get all filler for data table
     *
     * @return mixed
     */
    public function getAllFillerForDataTable()
    {
        return $this->model->filler()->with(['userDetail' => function ($query) {
            $query->select('user_id', 'contact_number1');
        }])->select('name', 'id', 'active');
    }

    /**
     * Get all filler
     *
     * @return mixed
     */
    public function getAllFiller()
    {
        return $this->model->filler()->with(['userDetail', 'company'])->get();
    }

    /**
     * Get filler by id
     *
     * @param int $id
     * @return mixed
     */
    public function getFillerById(int $id)
    {
        return $this->model->filler()->with(['userDetail', 'company' => function ($query) {
            $query->with(['state', 'postalState']);
        }, 'warehouse'                                               => function ($query) {
            $query->with(['warehouseTypes', 'dockTypes', 'additionalServiceOffers',
                'businessDocumentTypes', 'accreditations', 'ratesAndFees']);
        }])->findOrFail($id);
    }

    /**
     * Get finder By Id
     *
     * @param int $id
     * @return mixed
     */
    public function getFinderById(int $id)
    {
        return $this->model->finder()->with(['userDetail', 'company'])->findOrFail($id);
    }

    /**
     * For multiple delete
     *
     * @param array $selectedIds
     * @return int
     */
    public function multiDelete(array $selectedIds)
    {
        return $this->model->destroy($selectedIds);
    }

    /**
     * count users
     *
     * @return mixed
     */
    public function count()
    {
        return $this->model->count();
    }

    /**
     * Activates user.
     * @param string $email
     * @param string $token
     * @return bool
     */
    public function activate(string $email, string $token): bool
    {
        $passwordResetData = DB::table('password_resets')->where('email', $email)
            ->where('token', $token)->first();
        if (!$passwordResetData) {
            return false;
        }
        $user = app(User::class)->where('email', $email)->first();
        $user->update(['active' => 1]);
        DB::table('password_resets')->where('email', $email)->delete();

        return true;
    }

    /**
     * Sets Password
     * @param array  $inputData
     * @param string $token
     * @return bool
     */
    public function setPassword(array $inputData, string $token)
    {
        $this->databaseManager->beginTransaction();
        $user = app(User::class)->where('email', $inputData['email'])->first();
        $user->update(['password' => bcrypt($inputData['password'])]);
        if (!$this->activate($inputData['email'], $token)) {
            $this->databaseManager->rollBack();
        }
        $this->databaseManager->commit();

        return true;
    }

    /**
     * Saves token for new user.
     * @param array $data
     */
    public function saveToken(array $data)
    {
        DB::table('password_resets')->insert(['email' => $data['email'], 'token' => $data['token']]);
    }
}
