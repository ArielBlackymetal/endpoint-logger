<?php

namespace Arielblackymetal\EndpointLogger\Logging;

use Monolog\Logger;

class CustomLogger extends Logger
{
    public function usage(string $message, array $context = []): void
    {
        $this->log('usage', $message, $context);
    }

    public function invoice(string $message, array $context = []): void
    {
        $this->log('invoice', $message, $context);
    }

    public function custom(string $message, array $context = []): void
    {
        $this->log('custom', $message, $context);
    }
}