<?php

namespace Panelis\Setting\Drivers\Cache;

use Panelis\Setting\Drivers\CacheDriver;

class ArrayDriver extends CacheDriver
{
    public const string NAME = 'array';

    public function name(): string
    {
        return self::NAME;
    }

    public function label(): string
    {
        return __('setting::cache.array.label');
    }

    public function description(): ?string
    {
        return __('setting::cache.array.description');
    }
}
