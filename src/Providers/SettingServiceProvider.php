<?php

namespace Panelis\Setting\Providers;

use BezhanSalleh\LanguageSwitch\LanguageSwitch;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Panelis\Setting\Drivers\Cache\ArrayDriver;
use Panelis\Setting\Drivers\Cache\DatabaseDriver;
use Panelis\Setting\Drivers\Cache\DynamoDbDriver;
use Panelis\Setting\Drivers\Cache\FileDriver;
use Panelis\Setting\Drivers\Cache\MemcachedDriver;
use Panelis\Setting\Drivers\Cache\RedisDriver;
use Panelis\Setting\Drivers\Cache\StorageDriver;
use Panelis\Setting\Drivers\DriverManager;
use Panelis\Setting\Drivers\Mail\CloudflareDriver;
use Panelis\Setting\Drivers\Mail\LogDriver;
use Panelis\Setting\Drivers\Mail\MailgunDriver;
use Panelis\Setting\Drivers\Mail\PostmarkDriver;
use Panelis\Setting\Drivers\Mail\ResendDriver;
use Panelis\Setting\Drivers\Mail\SendmailDriver;
use Panelis\Setting\Drivers\Mail\SesDriver;
use Panelis\Setting\Drivers\Mail\SmtpDriver;
use Panelis\Setting\Events\SettingUpdated;
use Panelis\Setting\Listeners\FlushCache;

class SettingServiceProvider extends ServiceProvider
{
    private const string NAMESPACE = 'setting';

    public function register(): void
    {
        $this->app->singleton(DriverManager::class, fn (): DriverManager => new DriverManager);

        app(DriverManager::class)
            // mail
            ->register(new CloudflareDriver)
            ->register(new LogDriver)
            ->register(new MailgunDriver)
            ->register(new PostmarkDriver)
            ->register(new ResendDriver)
            ->register(new SendmailDriver)
            ->register(new SesDriver)
            ->register(new SmtpDriver)

            // cache
            ->register(new ArrayDriver)
            ->register(new DynamoDbDriver)
            ->register(new DatabaseDriver)
            ->register(new FileDriver)
            ->register(new MemcachedDriver)
            ->register(new RedisDriver)
            ->register(new StorageDriver);
    }

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
}
