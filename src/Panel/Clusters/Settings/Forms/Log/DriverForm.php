<?php

declare(strict_types=1);

namespace Panelis\Setting\Panel\Clusters\Settings\Forms\Log;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Panelis\Setting\Drivers\Driver;
use Panelis\Setting\Drivers\DriverManager;
use Panelis\Setting\Drivers\LogDriver;

class DriverForm
{
    public static function schema(): Section
    {
        $drivers = collect(app(DriverManager::class)->all(LogDriver::class));

        return Section::make(__('setting::log.label'))
            ->description(__('setting::log.section_description'))
            ->schema([
                Toggle::make('logging.enable_notification')
                    ->label(__('setting::log.enable_notification'))
                    ->helperText(__('setting::log.notification_helper'))
                    ->required(),

                CheckboxList::make('logging.channels.stack.channels')
                    ->label(__('setting::log.channel'))
                    ->live()
                    ->required()
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
