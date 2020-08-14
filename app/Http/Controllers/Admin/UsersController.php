<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsersRequest;
use App\Domain\Admin\Services\UsersService;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use DaveJamesMiller\Breadcrumbs\Facade as Breadcrumbs;

/**
 * Class UsersController
 * @package App\Http\Controllers\Admin
 */
class UsersController extends Controller
{

    /**
     * @var UsersService
     */
    protected $usersService;
    /**
     * @var Breadcrumbs
     */
    protected $breadcrumbs;

    /**
     * UsersController constructor.
     * @param UsersService $usersService
     * @param Guard        $auth
     * @param Breadcrumbs  $breadcrumbs
     */
    public function __construct(UsersService $usersService, Guard $auth, Breadcrumbs $breadcrumbs)
    {
        $this->usersService = $usersService;
        $this->breadcrumbs  = $breadcrumbs;
        $this->middleware('role:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users       = $this->usersService->getAllAdminUsers();
        $breadcrumbs = $this->breadcrumbs::render('users.index');

        return view('admin.users.index', compact('users', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userRoles   = getAdminUserRoles();
        $selected    = null;
        $breadcrumbs = $this->breadcrumbs::render('users.create');

        return view('admin.users.create', compact('userRoles', 'selected', 'breadcrumbs'));
    }

    /**
     * Create new user.
     *
     * @param UsersRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        $userData = [
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'active'   => isset($request->active) ? 1 : 0,
        ];
        try {
            $this->usersService->createUser($userData, $request->role);
            flash('User Successfully created.')->success();
        } catch (\Exception $exception) {
            logger()->info(sprintf('Unable to create new user because %s', $exception->getMessage()));
            flash('Unable to Create. If the error persists, contact '.config('palika.maintenanceContact'))->error();
        }

        return redirect(route('users.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $userId
     * @return \Illuminate\Http\Response
     */
    public function edit(int $userId)
    {
        $user        = $this->getUserById($userId);
        $userRoles   = getAdminUserRoles();
        $breadcrumbs = $this->breadcrumbs::render('users.edit', $user);
        if ($user) {
            $selected = $user->roles->first()->id;
        }

        return view('admin.users.edit', compact('user', 'userRoles', 'selected', 'breadcrumbs'));
    }

    /**
     * Get the user details when ID is provided.
     * @param $userId
     * @return bool|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
     */
    protected function getUserById($userId)
    {
        $user = $this->usersService->getById($userId);
        if (!$user) {
            abort(404);
        }

        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UsersRequest|Request $request
     * @param int                  $userId
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(UsersRequest $request, int $userId)
    {
        $user                 = $this->getUserById($userId);
        $passwordField        = ($request['password'] == null) ? 'password' : null;
        $ignoreFields         = [
            '_method',
            '_token',
            '_patch',
            $passwordField,
            'password_confirmation',
            'role',
        ];
        $updateData           = $request->except($ignoreFields);
        $updateData['active'] = isset($request->active) ? 1 : 0;
        if (isset($updateData['password'])) {
            $updateData['password'] = bcrypt($updateData['password']);
        }
        try {
            $this->usersService->update($user, $updateData, $request->role);
            flash('User Successfully updated.')->success();
        } catch (\Exception $exception) {
            logger()->info(sprintf('Unable to update a user because %s', $exception->getMessage()));
            flash('Unable to update. If the error persists, contact '.config('palika.maintenanceContact'))->error();
        }

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $userId
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(int $userId)
    {
        $user = $this->getUserById($userId);
        try {
            $this->usersService->deleteUser($user);
            flash('User Successfully deleted.')->success();
        } catch (\Exception $exception) {
            logger()->info(sprintf('Unable to delete a user because %s', $exception->getMessage()));
            flash('Unable to delete. If the error persists, contact '.config('palika.maintenanceContact'))->error();
        }

        return redirect(route('users.index'));
    }
}
