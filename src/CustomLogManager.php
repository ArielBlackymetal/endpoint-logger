<?php

namespace Arielblackymetal\EndpointLogger;

use Illuminate\Log\LogManager;

class CustomLogManager extends LogManager
{
    /**
     * Build an on-demand log channel.
     *
     * @param  array  $config
     * @return \Psr\Log\LoggerInterface
     */
    public function build(array $config)
    {
        $channel = $config['channels'][0] ?? $this->getDefaultDriver();

        $handler = new \Arielblackymetal\EndpointLogger\Logging\Handler\EndpointHandler(
            $config['url'] ?? null,
            config('app.name'),
            $config['level'] ?? 'debug'
        );

        // Agrega el procesador WebProcessor si está disponible
        if ($this->has('request')) {
            $handler->pushProcessor(new \Monolog\Processor\WebProcessor());
        }

        return new Logging\CustomLogger($channel, [$handler]);
    }
}