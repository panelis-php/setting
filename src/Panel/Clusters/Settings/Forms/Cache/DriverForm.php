<?php

namespace Panelis\Setting\Panel\Clusters\Settings\Forms\Cache;

use Filament\Forms\Components\Radio;
use Filament\Schemas\Components\Section;
use Panelis\Setting\Drivers\CacheDriver;
use Panelis\Setting\Drivers\Driver;
use Panelis\Setting\Drivers\DriverManager;

class DriverForm
{
    public static function schema(): Section
    {
        $drivers = collect(app(DriverManager::class)->all(CacheDriver::class));

        return Section::make(__('setting::cache.label'))
            ->description(__('setting::cache.section_description'))
            ->schema([
                Radio::make('cache.default')
                    ->live()
                    ->options(
                        collect($drivers)->mapWithKeys(fn (Driver $driver) => [
                            $driver->name() => $driver->label(),
                        ])
                    )
                    ->descriptions(
                        collect($drivers)->mapWithKeys(fn (Driver $driver) => [
                            $driver->name() => $driver->description(),
                        ])
                    ),
            ]);
    }
}
