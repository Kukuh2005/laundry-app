<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Outlet;

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
        // Periksa apakah tabel outlets ada
        if (Schema::hasTable('outlets')) {
            $outlet = Outlet::where('id', 1)->first();
            View::share('outlet', $outlet);
        }
    }
}
