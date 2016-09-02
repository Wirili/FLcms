<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator, Hash;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Validator::extend('hash', function ($attribute, $value, $parameters) {

            return Hash::check($value, count($parameters)>0?$parameters[0]:null);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
