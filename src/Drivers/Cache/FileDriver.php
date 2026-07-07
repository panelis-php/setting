<?php

namespace Panelis\Setting\Drivers\Cache;

use Panelis\Setting\Drivers\CacheDriver;

class FileDriver extends CacheDriver
{
    public const string NAME = 'file';

    public function name(): string
    {
        return self::NAME;
    }

    public function label(): string
    {
        return __('setting::cache.file.label');
    }

    public function description(): ?string
    {
        return __('setting::cache.file.description');
    }
}
