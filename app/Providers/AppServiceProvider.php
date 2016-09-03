<?php

namespace App\Providers;

use App\Models\User;
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
        Validator::extend('parent_name', function ($attribute, $value, $parameters) {
            return User::where('name',$value)->count() > 0;
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
