<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        Schema::defaultStringLength(191);

        view()->composer('*', function($view)
        {
            $view
            ->with('userCount', User::count())
            ->with('productCount', Product::count());
        });

    }
}
