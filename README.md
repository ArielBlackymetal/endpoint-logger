# Endpoing Logger for Laravel

This should be use for internal use only.

## Install package

```bash
composer require arielblackymetal/endpoint-logger
```

## Config

### .env

Add this line to your .env file with your endpoint url:

`LOG_ENDPOINT_URL=`

The endpoint will be called (`POST`) with the following data:

```php
[
    'level'    => $record->level->getName(),
    'message'  => $record->message,
    'context'  => $record->context,
    'app_name' => $this->appName,
]
```

### logging.php

Add this lines to your logging.php file:
```php
        'endpoint' => [
            'driver' => 'endpoint',
            'channels' => env(),
            'url' => env('LOG_ENDPOINT_URL', null)
        ],
```

You also can add the channel to the stack in `.env` file
```bash
LOG_STACK=single,endpoint
```

Or call the channel directly
```php

Log::channel('endpoint')->info('Hello World!', ['test' => 'test']);
```