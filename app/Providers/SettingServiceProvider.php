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
        $email = get_setting('email_setting');
        config(['mail' => array_merge(config('mail'), ($email? $email->options : []))]);
        config(['mail.from.address'=>config('mail.username')]);

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
