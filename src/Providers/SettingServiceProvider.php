<?php

namespace Panelis\Setting\Providers;

use BezhanSalleh\LanguageSwitch\LanguageSwitch;
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

        LanguageSwitch::configureUsing(function (LanguageSwitch $language): void {
            $language->locales(config('app.locales') ?? ['en']);
        });
    }

    public function register(): void
    {
        //
    }
}
