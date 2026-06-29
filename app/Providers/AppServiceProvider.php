<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use App\Listeners\AuditAuthEvents;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Event::listen(Login::class, AuditAuthEvents::class);
        Event::listen(Logout::class, AuditAuthEvents::class);

        Gate::before(function ($user, $ability) {
            if (!$user) {
                return null;
            }

            return $user->hasRole('super-admin') ? true : null;
        });

        // Stock Management Gates
        Gate::define('viewAnyStock', function ($user) {
            return (new \App\Policies\StockPolicy())->viewAny($user);
        });

        Gate::define('adjustStock', function ($user) {
            return (new \App\Policies\StockPolicy())->adjust($user);
        });

        Gate::define('viewHistoryStock', function ($user) {
            return (new \App\Policies\StockPolicy())->viewHistory($user);
        });
    }
}
