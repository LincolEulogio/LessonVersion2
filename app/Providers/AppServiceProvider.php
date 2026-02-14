<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        \Illuminate\Support\Facades\Auth::provider('legacy', function ($app, array $config) {
            return new \App\Providers\LegacyUserProvider($app['hash'], $config['model']);
        });

        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            $user = null;
            foreach (['systemadmin', 'teacher', 'student', 'parent', 'web'] as $guard) {
                if (\Illuminate\Support\Facades\Auth::guard($guard)->check()) {
                    $user = \Illuminate\Support\Facades\Auth::guard($guard)->user();
                    break;
                }
            }
            $view->with('user', $user);
        });
    }
}
