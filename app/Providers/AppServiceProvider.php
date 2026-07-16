<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\OrderObserver;
use App\Models\Order;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Order::observe(OrderObserver::class);

        \Illuminate\Support\Facades\Gate::before(function ($user, $ability) {
            $inventoryPermissions = ['stock_view', 'stock_adjust', 'stock_history_view', 'product.stock_update'];
            if ($user->hasRole('super-admin') && in_array($ability, $inventoryPermissions)) {
                return false;
            }
            return $user->hasRole('super-admin') ? true : null;
        });
    }
}
