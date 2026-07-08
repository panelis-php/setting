<?php

namespace Panelis\Setting\Drivers\Log;

use Panelis\Setting\Drivers\LogDriver;

class SingleDriver extends LogDriver
{
    public const string NAME = 'single';

    public function name(): string
    {
        return self::NAME;
    }

    public function label(): string
    {
        return __('setting::log.single.label');
    }

    public function description(): ?string
    {
        return __('setting::log.single.description');
    }
}
