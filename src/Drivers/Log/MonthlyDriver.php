<?php

namespace Panelis\Setting\Drivers\Log;

use Panelis\Setting\Drivers\LogDriver;

class MonthlyDriver extends LogDriver
{
    public const string NAME = 'monthly';

    public function name(): string
    {
        return self::NAME;
    }

    public function label(): string
    {
        return __('setting::log.monthly.label');
    }

    public function description(): ?string
    {
        return __('setting::log.monthly.description');
    }
}
