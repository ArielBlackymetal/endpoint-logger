<?php

namespace Arielblackymetal\EndpointLogger;

use Illuminate\Log\LogManager;
use Arielblackymetal\EndpointLogger\Logging\CustomLogger;
use Arielblackymetal\EndpointLogger\Logging\Handler\EndpointHandler;
use Monolog\Processor\WebProcessor;

class CustomLogManager extends LogManager
{
    protected function build(array $config): \Psr\Log\LoggerInterface
    {
        $channel = $config['channels'][0] ?? $this->getDefaultDriver();

        $handler = new EndpointHandler(
            $config['url'] ?? null,
            config('app.name'),
            $config['level'] ?? 'debug'
        );

        if ($this->has('request')) {
            $handler->pushProcessor(new WebProcessor());
        }

        return new CustomLogger($channel, [$handler]);
    }
}
