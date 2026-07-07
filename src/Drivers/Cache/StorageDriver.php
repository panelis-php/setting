<?php

namespace Panelis\Setting\Drivers\Cache;

use Panelis\Setting\Drivers\CacheDriver;

class StorageDriver extends CacheDriver
{
    public const string NAME = 'storage';

    public function name(): string
    {
        return self::NAME;
    }

    public function label(): string
    {
        return __('setting::cache.storage.label');
    }

    public function description(): ?string
    {
        return __('setting::cache.storage.description', ['disk' => config('filesystems.default')]);
    }
}
