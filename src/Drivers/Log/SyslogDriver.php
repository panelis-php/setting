<?php

namespace Panelis\Setting\Drivers\Log;

use Panelis\Setting\Drivers\LogDriver;

class SyslogDriver extends LogDriver
{
    public const string NAME = 'syslog';

    public function name(): string
    {
        return self::NAME;
    }

    public function label(): string
    {
        return __('setting::log.syslog.label');
    }

    public function description(): ?string
    {
        return __('setting::log.syslog.description');
    }
}
