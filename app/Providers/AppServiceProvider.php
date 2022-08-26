<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('superadmin_pabrik', function(User $user) {
            return $user->user_position === 'superadmin_pabrik';
        });

        Gate::define('superadmin_distributor', function(User $user) {
            return $user->user_position === 'superadmin_distributor';
        });

        Gate::define('reseller', function(User $user) {
            return $user->user_position === 'reseller';
        });

    }
}
