<?php

namespace Panelis\Setting\Drivers\Log;

use Panelis\Setting\Drivers\LogDriver;

class MonologDriver extends LogDriver
{
    public const string NAME = 'monolog';

    public function name(): string
    {
        return self::NAME;
    }

    public function label(): string
    {
        return __('setting::log.monolog.label');
    }

    public function description(): ?string
    {
        return __('setting::log.monolog.description');
    }
}
