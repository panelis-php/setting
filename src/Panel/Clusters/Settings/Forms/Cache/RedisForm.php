<?php

namespace Panelis\Setting\Panel\Clusters\Settings\Forms\Cache;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Panelis\Setting\Drivers\Cache\RedisDriver;
use Panelis\Setting\Drivers\CacheDriver;
use Panelis\Setting\Drivers\DriverManager;

class RedisForm
{
    public static function schema(): Section
    {
        $driver = app(DriverManager::class)->find(CacheDriver::class, RedisDriver::NAME);

        return Section::make(__('setting::cache.redis.label'))
            ->visible(fn (Get $get): bool => $get('cache.default') === $driver->name())
            ->disabled(! $driver->installed())
            ->schema([
                TextInput::make('database.redis.cache.host')
                    ->label(__('setting::cache.redis.host'))
                    ->required(),

                TextInput::make('database.redis.cache.port')
                    ->label(__('setting::cache.redis.port'))
                    ->required(),

                TextInput::make('database.redis.cache.database')
                    ->label(__('setting::cache.redis.database'))
                    ->numeric()
                    ->required(),

                TextInput::make('database.redis.cache.username')
                    ->label(__('setting::cache.redis.username'))
                    ->string(),

                TextInput::make('database.redis.cache.password')
                    ->label(__('setting::cache.redis.password'))
                    ->string()
                    ->password()
                    ->revealable(),
            ]);
    }
}
