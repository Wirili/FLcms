<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator,Hash;

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
        Validator::extend('password', function($attribute, $value, $parameters) {
            return Hash::check($value,\Auth::user()->password);
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
