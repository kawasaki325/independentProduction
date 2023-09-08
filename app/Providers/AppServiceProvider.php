<?php

namespace App\Providers;

use Cloudinary\Cloudinary;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;

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
        \Illuminate\Support\Facades\Schema::defaultStringLength(191);

        Paginator::useBootstrap();


        if (config('app.env')==='production'){
            \URL::forceScheme('https');
     }
    }
}
