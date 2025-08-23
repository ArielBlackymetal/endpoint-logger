<?php

namespace ArielBlackymetal\EndpointLogger\Logging;

use Monolog\Logger;

class CustomLogger extends Logger
{
    /**
     * Custom log levels for business reporting
     */
    const INVOICE = 250; // Between INFO (200) and WARNING (300)

    /**
     * Initialize custom log levels
     */
    public function __construct(string $name, array $handlers = [], array $processors = [])
    {
        parent::__construct($name, $handlers, $processors);
    }

    /**
     * Log an invoice message
     */
    public function invoice(string $message, array $context = []): void
    {
        $this->addRecord(self::INVOICE, $message, $context);
    }
}
