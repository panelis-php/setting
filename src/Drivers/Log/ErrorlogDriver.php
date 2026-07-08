<?php

namespace Panelis\Setting\Drivers\Log;

use Panelis\Setting\Drivers\LogDriver;

class ErrorlogDriver extends LogDriver
{
    public const string NAME = 'errorlog';

    public function name(): string
    {
        return self::NAME;
    }

    public function label(): string
    {
        return __('setting::log.errorlog.label');
    }

    public function description(): ?string
    {
        return __('setting::log.errorlog.description');
    }
}
