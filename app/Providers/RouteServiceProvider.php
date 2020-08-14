<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

/**
 * Class RouteServiceProvider
 * @package App\Providers
 */
class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var array
     *
     **/
    protected $namespace = [
        'auth'   => 'App\Http\Controllers',
        'admin'  => 'App\Http\Controllers\Admin',
        'api'    => 'App\Http\Controllers\Api',
        'frontend'    => 'App\Http\Controllers\Frontend',
    ];


    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @param Router $route
     * @return void
     */
    public function map(Router $route)
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
        $this->mapAuthRoutes($route);
        $this->mapAdminRoutes($route);
        $this->mapFrontendRoutes($route);
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace['api'])
            ->group(base_path('routes/api.php'));
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace['auth'])
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "auth" routes for the application.
     * These routes all receive session state, CSRF protection, etc.
     *
     * @param Router $route
     *
     * @return void
     */
    protected function mapAuthRoutes(Router $route)
    {
        $route->group(
            [
                'namespace'  => $this->namespace['auth'],
                'prefix'     => 'administrator',
                'middleware' => 'web',
            ],
            function ($route) {
                require base_path('routes/admin/auth.php');
            }
        );
    }

    /**
     * Define the "admin" routes for the application.
     * @param Router $route
     */
    protected function mapAdminRoutes(Router $route)
    {
        $route->group(
            [
                'namespace'  => $this->namespace['admin'],
                'prefix'     => 'administrator',
                'middleware' => ['web', 'auth'],
            ],
            function ($route) {
                require base_path('routes/admin/admin.php');
                require base_path('routes/admin/users.php');
            }
        );
    }

    /**
     * Define the "admin" routes for the application.
     * @param Router $route
     */
    protected function mapFrontendRoutes(Router $route)
    {
        $route->group(
            [
                'namespace'  => $this->namespace['frontend'],
            ],
            function ($route) {
                require base_path('routes/frontend/frontend.php');
            }
        );
    }
}
