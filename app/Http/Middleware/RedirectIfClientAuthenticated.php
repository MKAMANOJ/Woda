<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class RedirectIfClientAuthenticated
 * @package App\Http\Middleware
 */
class RedirectIfClientAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->guard('front')->check()) {
            $userRole = currentNonAdminUser()->role_name;
            $route    = sprintf('%s.dashboard', $userRole);
            if (request()->ajax()) {
                return response([
                    'status' => true, 'message' => 'You are already Signed In', 'redirect_url' => route($route),
                ]);
            }

            return redirect()->route($route);
        }

        return $next($request);
    }
}
