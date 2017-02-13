<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Mail Config Change
        config(['mail' => array_merge(config('mail'), get_setting('email_setting')->options)]);

        // FTP Config Change
//        config(['mail' => array_merge(config('mail'), get_setting('email_setting')->options)]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
