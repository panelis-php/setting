<?php

namespace Panelis\Setting\Drivers\Cache;

use Filament\Schemas\Components\Section;
use Panelis\Setting\Drivers\CacheDriver;
use Panelis\Setting\Panel\Clusters\Settings\Forms\Cache\RedisForm;

class RedisDriver extends CacheDriver
{
    public const NAME = 'redis';

    public function name(): string
    {
        return self::NAME;
    }

    public function label(): string
    {
        return __('setting::cache.redis.label');
    }

    public function description(): ?string
    {
        return __('setting::cache.redis.description');
    }

    public function schema(): ?Section
    {
        return RedisForm::schema();
    }
}
