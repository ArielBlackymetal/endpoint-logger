<?php

namespace Arielblackymetal\EndpointLogger\Logging\Handler;

use Illuminate\Support\Facades\Http;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\LogRecord;
use Monolog\Logger;

class EndpointHandler extends AbstractProcessingHandler
{
    private $url;
    private $appName;

    public function __construct(string $url, string $appName, $level = 'debug', bool $bubble = true)
    {
        $monologLevel = Logger::toMonologLevel($level);
        parent::__construct($monologLevel, $bubble);

        $this->url = $url;
        $this->appName = $appName;
    }

    protected function write(LogRecord $record): void
    {
        Http::post($this->url, [
            'level'    => $record->level->getName(),
            'message'  => $record->message,
            'context'  => $record->context,
            'app_name' => $this->appName,
            'extra'    => $record->extra,
            'log_type' => $record->level->getName(),
        ]);
    }
}
