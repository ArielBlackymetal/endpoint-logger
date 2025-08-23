<?php

namespace ArielBlackymetal\EndpointLogger\Logging\Handler;

use Illuminate\Support\Facades\Http;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\LogRecord;

class EndpointHandler extends AbstractProcessingHandler
{
    private $url;
    private $appName;

    public function __construct(string $url, string $appName, $level = 'debug', bool $bubble = true)
    {
        parent::__construct($level, $bubble);
        $this->url = $url;
        $this->appName = $appName;
    }

    protected function write(LogRecord $record): void
    {
        // Get the log type, handling custom levels
        $logType = $record->level->getName();

        // For custom levels, we need to map them to their string representation
        if ($record->level->value === 250) {
            $logType = 'INVOICE';
        }

        Http::post($this->url, [
            'severity'    => $record->level->value,
            'log_type'    => $logType,
            'message'  => $record->message,
            'context'  => $record->context,
            'app_name' => $this->appName,
            'ocurred_at' => $record->datetime,
            'metadata' => $record->extra
        ]);
    }
}
