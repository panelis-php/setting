<?php

namespace Panelis\Setting\Panel\Clusters\Settings\Forms\Log;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Panelis\Setting\Drivers\Driver;
use Panelis\Setting\Drivers\DriverManager;
use Panelis\Setting\Drivers\Log\PapertrailDriver;
use Panelis\Setting\Drivers\LogDriver;
use Panelis\Setting\Panel\Clusters\Settings\Enums\LogLevel;

class PapertrailForm
{
    public static function schema(): Section
    {
        /**
         * @var Driver $driver
         */
        $driver = app(DriverManager::class)->find(LogDriver::class, PapertrailDriver::NAME);

        return Section::make()
            ->visible(fn (Get $get): bool => in_array($driver->name(), $get('logging.channels.stack.channels')))
            ->schema([
                Select::make('logging.channels.papertrail.level')
                    ->label(__('setting::log.level'))
                    ->options(LogLevel::class)
                    ->searchable()
                    ->required()
                    ->dehydrateStateUsing(function (?LogLevel $state): ?string {
                        if ($state instanceof LogLevel) {
                            return $state->value;
                        }

                        return $state;
                    })
                    ->enum(LogLevel::class),

                TextInput::make('logging.channels.papertrail.url')
                    ->label(__('setting::log.papertrail.url'))
                    ->url()
                    ->required(),

                TextInput::make('logging.channels.papertrail.port')
                    ->label(__('setting::log.papertrail.port'))
                    ->numeric()
                    ->required(),
            ]);
    }
}
