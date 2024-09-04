<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        Gate::before(function ($user, $ability) {
            return $user->hasRole('superadmin') ? true : null;
        });

        Config::set('mail_mailer', env('MAIL_MAILER'));
        Config::set('mail_host', env('MAIL_HOST'));
        Config::set('mail_port', env('MAIL_PORT'));
        Config::set('mail_username', env('MAIL_USERNAME'));
        Config::set('mail_password', env('MAIL_PASSWORD'));
        Config::set('mail_encryption', env('MAIL_ENCRYPTION'));
        Config::set('mail_from_address', env('MAIL_FROM_ADDRESS'));
        Config::set('mail_from_name', env('MAIL_FROM_NAME'));
    }
}
