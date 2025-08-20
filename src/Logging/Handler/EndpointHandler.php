<?php

namespace ArielBlackymetal\EndpointLogger\Logging\Handler;

use Illuminate\Support\Facades\Http;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use Monolog\LogRecord;

class EndpointHandler extends AbstractProcessingHandler
{
    private $url;
    private $appName;

    public function __construct(string $url, string $appName, $level = Logger::DEBUG, bool $bubble = true)
    {
        parent::__construct($level, $bubble);
        $this->url = $url;
        $this->appName = $appName;
    }

    protected function write(LogRecord $record): void
    {
        Http::post($this->url, [
            'severity'    => $record->level->value,
            'log_type'    => $record->level->getName(),
            'message'  => $record->message,
            'context'  => $record->context,
            'app_name' => $this->appName,
            'ocurred_at' => $record->datetime,
            'metadata' => $record->extra
        ]);
    }
}
