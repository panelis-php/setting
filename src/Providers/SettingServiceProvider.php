<?php

namespace Panelis\Setting\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Panelis\Setting\Events\SettingUpdated;
use Panelis\Setting\Listeners\FlushCache;

class SettingServiceProvider extends ServiceProvider
{
    private const string NAMESPACE = 'setting';

    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../../lang', self::NAMESPACE);

        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');

        $this->loadViewsFrom(__DIR__.'/../../resources/views', self::NAMESPACE);

        Event::listen(SettingUpdated::class, FlushCache::class);
    }

    public function register(): void
    {
        //
    }
}
