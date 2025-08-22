<?php

namespace Arielblackymetal\EndpointLogger;

use Illuminate\Support\ServiceProvider;

class EndpointLoggerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('log', function ($app) {
            return new CustomLogManager($app);
        });
    }

    public function boot(): void
    {
        //
    }
}
