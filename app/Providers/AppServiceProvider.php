<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        Schema::defaultStringLength(191);

        // Language Settings
        // sets locale to the value of the language cookie
        // if language cookie is not set, it sets it to "en"
        if(!isset($_COOKIE['language'])) {
            setcookie("language", "en", time() + (86400 * 30), "/"); // 86400 = 1 day
            App::setLocale('en');
        }
        else {
            App::setLocale($_COOKIE['language']);
        }
    }
}
