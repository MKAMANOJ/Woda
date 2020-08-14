<?php

namespace App\Providers;

use App\Http\ViewComposers\FrontendComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

/**
 * Class ComposerServiceProvider
 * @package App\Providers
 */
class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('admin.layouts.sidebar', 'App\Http\ViewComposers\MenuComposer');
        View::composer('layouts.frontend', FrontendComposer::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(FrontHeaderFooterComposer::class);
        $this->app->singleton(FrontLeftSidebarComposer::class);
    }
}
