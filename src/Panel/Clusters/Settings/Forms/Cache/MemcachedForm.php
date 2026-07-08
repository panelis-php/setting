<?php

namespace Panelis\Setting\Panel\Clusters\Settings\Forms\Cache;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Panelis\Setting\Drivers\Cache\MemcachedDriver;
use Panelis\Setting\Drivers\CacheDriver;
use Panelis\Setting\Drivers\DriverManager;

class MemcachedForm
{
    public static function schema(): Section
    {
        $driver = app(DriverManager::class)->find(CacheDriver::class, MemcachedDriver::NAME);

        return Section::make(__('setting::cache.memcached.label'))
            ->visible(fn (Get $get): bool => $get('cache.default') === $driver->name())
            ->disabled(! $driver->installed())
            ->schema([
                TextInput::make('cache.stores.memcached.servers.host')
                    ->label(__('setting::cache.memcached.host'))
                    ->required(),

                TextInput::make('cache.stores.memcached.servers.port')
                    ->label(__('setting::cache.memcached.port'))
                    ->numeric()
                    ->required(),

                TextInput::make('cache.stores.memcached.sasl.username')
                    ->label(__('setting::cache.memcached.username'))
                    ->numeric()
                    ->nullable(),

                TextInput::make('cache.stores.memcached.sasl.password')
                    ->label(__('setting::cache.memcached.password'))
                    ->password()
                    ->revealable()
                    ->nullable(),
            ]);
    }
}
