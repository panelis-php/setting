<?php

namespace Panelis\Setting\Drivers\Cache;

use Panelis\Setting\Drivers\CacheDriver;

class DatabaseDriver extends CacheDriver
{
    private const string NAME = 'database';

    public function name(): string
    {
        return self::NAME;
    }

    public function label(): string
    {
        return __('setting::cache.database.label');
    }

    public function description(): ?string
    {
        return __('setting::cache.database.description', ['db' => config('database.default')]);
    }
}
