<?php

namespace App\Providers;

use App\Advert;
use App\Forum;
use App\Policies\AdvertPolicy;
use App\Policies\ForumPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Advert::class => AdvertPolicy::class,
        Forum::class => ForumPolicy::class,
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
