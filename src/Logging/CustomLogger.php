<?php

namespace ArielBlackymetal\EndpointLogger\Logging;

use Monolog\Logger;

class CustomLogger extends Logger
{
    /**
     * Custom log levels for business reporting
     */
    const INVOICE = 250; // Between INFO (200) and WARNING (300)
    const PAYMENT = 251;
    const REFUND = 252;
    const SUBSCRIPTION = 253;
    const CUSTOMER = 254;
    const REPORT = 255;

    /**
     * Initialize custom log levels
     */
    public function __construct(string $name, array $handlers = [], array $processors = [])
    {
        parent::__construct($name, $handlers, $processors);
        
        // In Monolog 3, custom levels are handled differently
        // We'll use the addRecord method directly in our custom methods
    }

    /**
     * Log an invoice message
     */
    public function invoice(string $message, array $context = []): void
    {
        $this->addRecord(self::INVOICE, $message, $context);
    }

    /**
     * Log a payment message
     */
    public function payment(string $message, array $context = []): void
    {
        $this->addRecord(self::PAYMENT, $message, $context);
    }

    /**
     * Log a refund message
     */
    public function refund(string $message, array $context = []): void
    {
        $this->addRecord(self::REFUND, $message, $context);
    }

    /**
     * Log a subscription message
     */
    public function subscription(string $message, array $context = []): void
    {
        $this->addRecord(self::SUBSCRIPTION, $message, $context);
    }

    /**
     * Log a customer message
     */
    public function customer(string $message, array $context = []): void
    {
        $this->addRecord(self::CUSTOMER, $message, $context);
    }

    /**
     * Log a report message
     */
    public function report(string $message, array $context = []): void
    {
        $this->addRecord(self::REPORT, $message, $context);
    }
}
