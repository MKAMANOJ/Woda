<?php

namespace App\Providers;

use App\Domain\Front\Policies\QuotePolicy;
use App\Domain\Front\Policies\ScheduleMovementPolicy;
use App\EBP\Entities\Quotation\Quotation;
use App\EBP\Entities\ScheduleMovement\ScheduleMovement;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model'             => 'App\Policies\ModelPolicy',
        Quotation::class        => QuotePolicy::class,
        ScheduleMovement::class => ScheduleMovementPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
