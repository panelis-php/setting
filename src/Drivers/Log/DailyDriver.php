<?php

namespace Panelis\Setting\Drivers\Log;

use Panelis\Setting\Drivers\LogDriver;

class DailyDriver extends LogDriver
{
    public const string NAME = 'daily';

    public function name(): string
    {
        return self::NAME;
    }

    public function label(): string
    {
        return __('setting::log.daily.label');
    }

    public function description(): ?string
    {
        return __('setting::log.daily.description');
    }
}
