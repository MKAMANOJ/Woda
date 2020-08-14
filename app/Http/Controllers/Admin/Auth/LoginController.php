<?php

namespace App\Http\Controllers\Admin\Auth;

use App\EBP\Constants\UserRole;
use App\EBP\Entities\Role;
use App\EBP\Entities\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

/**
 * Class LoginController
 * @package App\Http\Controllers\Admin\Auth
 */
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/administrator';

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Login the admin user only.
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        $roleId = app(Role::class)->where('name', UserRole::ADMIN)->first()->id;
        $user   = User::whereHas(
            'roles', function ($query) use ($roleId) {
            $query->where('id', $roleId);
        }
        )->where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('error_message', 'Unable to login. Please check your credentials.');
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'active' => 1])) {
            return redirect()->intended($this->redirectTo);
        }

        return redirect()->back()->with('error_message', 'Unable to login. Please check your credentials.');
    }


    /**
     * Log out the admin user.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return redirect()->to($this->redirectTo);
    }

}
