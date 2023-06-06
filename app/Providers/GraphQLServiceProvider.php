<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Session\Middleware\StartSession;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class GraphQLServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SessionInterface::class, function () {
            return $this->app['session.store'];
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['router']->aliasMiddleware('session', StartSession::class);
    }
}
