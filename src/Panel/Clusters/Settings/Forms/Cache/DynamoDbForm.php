<?php

namespace Panelis\Setting\Panel\Clusters\Settings\Forms\Cache;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Callout;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Panelis\Setting\Drivers\Cache\DynamoDbDriver;
use Panelis\Setting\Drivers\CacheDriver;
use Panelis\Setting\Drivers\DriverManager;

class DynamoDbForm
{
    public static function schema(): Section
    {
        $driver = app(DriverManager::class)->find(CacheDriver::class, DynamoDbDriver::NAME);

        return Section::make(__('setting::cache.dynamodb.label'))
            ->visible(fn (Get $get): bool => $get('cache.default') === $driver->name())
            ->disabled(! $driver->installed())
            ->schema([
                Callout::make(__('setting::cache.dynamodb.no_package_title'))
                    ->description(__('setting::cache.dynamodb.no_package_description'))
                    ->warning()
                    ->hidden($driver->installed()),

                TextInput::make('cache.stores.dynamodb.key')
                    ->label(__('setting::cache.dynamodb.key'))
                    ->required(),

                TextInput::make('cache.stores.dynamodb.secret')
                    ->label(__('setting::cache.dynamodb.secret'))
                    ->password()
                    ->revealable()
                    ->required(),

                TextInput::make('cache.stores.dynamodb.region')
                    ->label(__('setting::cache.dynamodb.region'))
                    ->required(),

                TextInput::make('cache.stores.dynamodb.table')
                    ->label(__('setting::cache.dynamodb.table'))
                    ->required(),

                TextInput::make('cache.stores.dynamodb.endpoint')
                    ->label(__('setting::cache.dynamodb.endpoint'))
                    ->required(),
            ]);
    }
}
