<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HttpKernelServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->afterResolving('router', function ($router) {
            $router->aliasMiddleware('role', \App\Http\Middleware\RoleMiddleware::class);
            $router->aliasMiddleware('permission', \App\Http\Middleware\PermissionMiddleware::class);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
