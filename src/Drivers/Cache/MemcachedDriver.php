<?php

namespace Panelis\Setting\Drivers\Cache;

use Filament\Schemas\Components\Section;
use Panelis\Setting\Drivers\CacheDriver;
use Panelis\Setting\Panel\Clusters\Settings\Forms\Cache\MemcachedForm;

class MemcachedDriver extends CacheDriver
{
    public const string NAME = 'memcached';

    public function name(): string
    {
        return self::NAME;
    }

    public function label(): string
    {
        return __('setting::cache.memcached.label');
    }

    public function description(): ?string
    {
        return __('setting::cache.memcached.description');
    }

    public function schema(): ?Section
    {
        return MemcachedForm::schema();
    }
}
