<?php

namespace ArielBlackymetal\EndpointLogger;

use Illuminate\Support\Facades\Log;
use Monolog\Processor\WebProcessor;
use Illuminate\Support\ServiceProvider;
use Arielblackymetal\EndpointLogger\Logging\CustomLogger;
use ArielBlackymetal\EndpointLogger\Logging\Handler\EndpointHandler;

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

            $logger = new CustomLogger('custom-log', [$handler]);

            return $logger;
        });
    }
}
