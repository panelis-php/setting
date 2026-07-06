<?php

declare(strict_types=1);

namespace Panelis\Setting\Panel\Clusters\Settings\Forms\Mail;

use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Callout;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Panelis\Setting\Drivers\DriverManager;
use Panelis\Setting\Drivers\Mail\CloudflareDriver;
use Panelis\Setting\Drivers\MailDriver;

class CloudflareForm
{
    public static function schema(string $version): Section
    {
        $driver = app(DriverManager::class)->find(MailDriver::class, CloudflareDriver::NAME);

        return Section::make(__('setting::mail.cloudflare.name'))
            ->visible(fn (Get $get): bool => $get('mail.default') === $driver->name())
            ->disabled(! $driver->installed())
            ->description(__('setting::mail.cloudflare.description'))
            ->schema([
                Callout::make(__('setting::mail.cloudflare.no_package_title'))
                    ->description(__('setting::mail.cloudflare.no_package_description'))
                    ->visible(! $driver->installed())
                    ->warning()
                    ->actions([
                        Action::make('veiw_doc')
                            ->label(__('setting::mail.btn.view_doc'))
                            ->url(sprintf('https://laravel.com/docs/%s.x/mail#cloudflare-driver', $version)),
                    ]),

                TextInput::make('services.cloudflare.account_id')
                    ->label(__('setting::mail.cloudflare.account_id'))
                    ->required(),

                TextInput::make('services.cloudflare.key')
                    ->label(__('setting::mail.cloudflare.key'))
                    ->password()
                    ->revealable()
                    ->required(),
            ]);
    }
}
