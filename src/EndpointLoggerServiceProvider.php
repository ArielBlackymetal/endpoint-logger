<?php

namespace Arielblackymetal\EndpointLogger;

use Illuminate\Support\ServiceProvider;
use Monolog\Processor\WebProcessor;
use Illuminate\Support\Facades\Log;
use ArielBlackymetal\EndpointLogger\Logging\Handler\EndpointHandler;
use ArielBlackymetal\EndpointLogger\Logging\CustomLogger;

class EndpointLoggerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Log::extend('endpoint', function ($app, array $config) {
            $appName = $app['config']->get('app.name');
            $url = $config['url'] ?? null;
            $level = $config['level'] ?? 'debug';

            $handler = new EndpointHandler($url, $appName, $level);

            $handler->pushProcessor(new WebProcessor());

            return new CustomLogger('custom-log', [$handler]);
        });
    }
}
