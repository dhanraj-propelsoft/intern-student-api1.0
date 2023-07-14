<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        Validator::extend('alpha_spaces', function ($attribute, $value) {
            // This rule will pass if the value contains only alphabets and spaces
            return preg_match('/^[\pL\s]+$/u', $value);
        });
    }
}
