<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('userId', function ($user) {
            return $user->id;
        });

        Gate::define('isAdmin', function ($user) {
            return $user->type === 'admin';
        });

        Gate::define('isAuthor', function ($user) {
            return $user->type === 'author';
        });

        Gate::define('isUser', function ($user) {
            return $user->type === 'user';
        });
		//deprecated in Laravel 9
        //Passport::routes();

        //
    }
}
