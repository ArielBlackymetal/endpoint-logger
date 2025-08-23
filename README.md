# Endpoint Logger for Laravel

A Laravel logging driver package for sending logs to a centralized endpoint with support for custom business reporting levels.

## Features

- Custom driver for Laravel Logging
- Automatic log sending to HTTP endpoint
- Standard logging levels (debug, info, warning, error, critical)
- **NEW**: Custom levels for business reporting
- WebProcessor included for additional web context information

## Custom Levels Available

The package includes custom levels designed for business reporting:

- **INVOICE** (250) - For billing-related logs

## Installation

1. Install the package via Composer:
```bash
composer require arielblackymetal/endpoint-logger
```

2. The ServiceProvider will be automatically registered in Laravel.

## Configuration

Add a channel in your `config/logging.php` file:

```php
'channels' => [
    // ... existing channels ...

    'ax1-info' => [
        'driver' => 'endpoint',
        'url' => 'https://your-endpoint.com/api/logs',
        'level' => 'debug', // Minimum level to capture all logs
    ],

    'ax1-invoice' => [
        'driver' => 'endpoint',
        'url' => 'https://your-endpoint.com/api/logs',
        'level' => 'invoice', // Only captures invoice level and above
    ],
],
```

## Usage

### Standard Levels
```php
Log::channel('ax1-info')->info('Information message');
Log::channel('ax1-info')->error('System error');
Log::channel('ax1-info')->warning('Important warning');
```

### Custom Business Levels
```php

// Invoice
Log::channel('ax1-info')->invoice('Sales report generated', ['count' => 2, 'amount' => 150.00]);
```

## Payload Structure

Each log sent to the endpoint includes:

```json
{
    "severity": 250,
    "log_type": "INVOICE",
    "message": "Invoice transmitted",
    "context": {
        "count": 2,
        "amount": 150.00
    },
    "app_name": "My Application",
    "ocurred_at": "2024-01-15T10:30:00+00:00",
    "metadata": {
        // Additional web context information
    }
}
```

## Benefits of Custom Levels

1. **Smart Filtering**: Configure channels that only capture specific types of business logs
2. **Specific Reporting**: Generate reports based on specific event types
3. **Business Monitoring**: Separate technical logs from business logs
4. **Advanced Analytics**: Enable granular analysis of different business aspects

## Advanced Configuration Examples

### Invoice-Only Channel
```php
'ax1-invoice-only' => [
    'driver' => 'endpoint',
    'url' => 'https://your-endpoint.com/api/invoices',
    'level' => 'invoice', // Only captures invoice logs
],
```

### Channel for All Business Events
```php
'ax1-business' => [
    'driver' => 'endpoint',
    'url' => 'https://your-endpoint.com/api/business',
    'level' => 'invoice', // Captures invoice and all levels above
],
```

## Requirements

- PHP >= 8.1
- Laravel >= 10.0
- Monolog >= 3.0

## License

This package is open-sourced software licensed under the MIT license.