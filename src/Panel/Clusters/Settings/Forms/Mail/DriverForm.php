<?php

declare(strict_types=1);

namespace Panelis\Setting\Panel\Clusters\Settings\Forms\Mail;

use Filament\Forms\Components\Radio;
use Filament\Schemas\Components\Section;
use Panelis\Setting\Drivers\Driver;
use Panelis\Setting\Drivers\DriverManager;
use Panelis\Setting\Drivers\MailDriver;

class DriverForm
{
    public static function schema(): Section
    {
        $drivers = collect(app(DriverManager::class)->all(MailDriver::class));

        return Section::make(__('setting::mail.label'))
            ->description(__('setting::mail.section_description'))
            ->schema([
                Radio::make('mail.default')
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
