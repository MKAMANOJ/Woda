<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class AuthenticateClient
 * @package App\Http\Middleware
 */
class AuthenticateClient
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
        if (!auth()->guard('front')->check()) {
            return redirect('/');
        }

        return $next($request);
    }
}
