<?php

namespace Shahvirag\LaravelUiBootstrap;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class LaravelUiBootstrapServiceProvider extends ServiceProvider
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
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
            ]);
        }

        if (class_exists(Fortify::class)) {
            Fortify::loginView(function () {
                return file_exists(resource_path('views/auth/login.blade.php'))
                    ? view('auth.login')
                    : view('laravel-ui-bootstrap4::auth.login');
            });

            Fortify::registerView(function () {
                return file_exists(resource_path('views/auth/register.blade.php'))
                    ? view('auth.register')
                    : view('laravel-ui-bootstrap4::auth.register');
            });

            Fortify::confirmPasswordView(function () {
                return file_exists(resource_path('views/auth/passwords/confirm.blade.php'))
                    ? view('auth.passwords.confirm')
                    : view('laravel-ui-bootstrap4::auth.passwords.confirm');
            });

            Fortify::requestPasswordResetLinkView(function () {
                return file_exists(resource_path('views/auth/passwords/email.blade.php'))
                    ? view('auth.passwords.email')
                    : view('laravel-ui-bootstrap4::auth.passwords.email');
            });

            Fortify::resetPasswordView(function () {
                return file_exists(resource_path('views/auth/passwords/reset.blade.php'))
                    ? view('auth.passwords.reset')
                    : view('laravel-ui-bootstrap4::auth.passwords.reset');
            });

            Fortify::verifyEmailView(function () {
                return file_exists(resource_path('views/auth/verify.blade.php'))
                    ? view('auth.verify')
                    : view('laravel-ui-bootstrap4::auth.verify');
            });

            $this->loadViewsFrom(__DIR__ . '/../resources/views', 'laravel-ui-bootstrap4');
        }
    }
}
