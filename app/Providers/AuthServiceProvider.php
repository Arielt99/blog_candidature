<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Post' => 'App\Policies\PostPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /* define a Administrator user role */
        Gate::define('isAdministrator', function($user) {
           return $user->role->name == 'Administrator';
        });

        /* define a Moderator user role */
        Gate::define('isModerator', function($user) {
            return $user->role->name == 'Moderator';
        });

        /* define a Author role */
        Gate::define('isAuthor', function($user) {
            return $user->role->name == 'Author';
        });
    }
}
