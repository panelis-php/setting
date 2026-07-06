<?php

declare(strict_types=1);

namespace Panelis\Setting\Panel\Clusters\Settings\Forms\Mail;

use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Callout;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Panelis\Setting\Drivers\DriverManager;
use Panelis\Setting\Drivers\Mail\MailgunDriver;
use Panelis\Setting\Drivers\MailDriver;

class MailgunForm
{
    public static function schema(string $version): Section
    {
        $driver = app(DriverManager::class)->find(MailDriver::class, MailgunDriver::NAME);

        return Section::make(__('setting::mail.mailgun.name'))
            ->visible(fn (Get $get): bool => $get('mail.default') === $driver->name())
            ->disabled(! $driver->installed())
            ->schema([
                Callout::make(__('setting::mail.mailgun.no_package_title'))
                    ->description(__('setting::mail.mailgun.no_package_description'))
                    ->visible(! $driver->installed())
                    ->warning()
                    ->actions([
                        Action::make('view_doc')
                            ->label(__('setting::mail.btn.view_doc'))
                            ->url(sprintf('https://laravel.com/docs/%s.x/mail#mailgun-driver', $version)),
                    ]),

                TextInput::make('services.mailgun.domain')
                    ->label(__('setting::mail.mailgun.domain'))
                    ->string()
                    ->required(),

                TextInput::make('services.mailgun.secret')
                    ->label(__('setting::mail.mailgun.secret'))
                    ->password()
                    ->revealable()
                    ->required(),

                TextInput::make('services.mailgun.endpoint')
                    ->label(__('setting::mail.mailgun.endpoint'))
                    ->string()
                    ->required(),
            ]);
    }
}
