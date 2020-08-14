<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

/**
 * Class EntrustRole
 * @package App\Http\Middleware
 */
class EntrustRole
{
    /**
     * @var Guard
     */
    protected $auth;

    /**
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Creates a new instance of the middleware.
     *
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Closure                  $next
     * @param                           $roles
     * @param null                      $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {
        if ($this->auth->guest() || !$request->user()->hasRole(explode('|', $roles))) {
            flash('You don\'t have access to the content.')->error();

            return redirect($this->redirectTo);
        }

        return $next($request);
    }
}
