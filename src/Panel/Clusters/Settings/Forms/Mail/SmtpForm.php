<?php

declare(strict_types=1);

namespace Panelis\Setting\Panel\Clusters\Settings\Forms\Mail;

use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Panelis\Setting\Drivers\DriverManager;
use Panelis\Setting\Drivers\Mail\SmtpDriver;
use Panelis\Setting\Drivers\MailDriver;

class SmtpForm
{
    public static function schema(): Section
    {
        $driver = app(DriverManager::class)->find(MailDriver::class, SmtpDriver::NAME);

        $isDemo = config('panelis.demo');
        $demoText = function (): ?string {
            if (config('panelis.demo')) {
                return __('setting::setting.hidden_when_in_demo');
            }

            return null;
        };

        return Section::make(__('setting::mail.smtp.name'))
            ->visible(fn (Get $get): bool => $get('mail.default') === $driver->name())
            ->schema([
                TextInput::make('mail.mailers.smtp.host')
                    ->label(__('setting::mail.smtp.host'))
                    ->password($isDemo)
                    ->helperText($demoText)
                    ->required(),

                TextInput::make('mail.mailers.smtp.port')
                    ->label(__('setting::mail.smtp.port'))
                    ->integer()
                    ->required(),

                TextInput::make('mail.mailers.smtp.username')
                    ->label(__('setting::mail.smtp.username'))
                    ->password($isDemo)
                    ->helperText($demoText)
                    ->autocomplete(false)
                    ->nullable(),

                TextInput::make('mail.mailers.smtp.password')
                    ->label(__('setting::mail.smtp.password'))
                    ->autocomplete(false)
                    ->password()
                    ->revealable()
                    ->nullable(),

                Radio::make('mail.mailers.smtp.encryption')
                    ->label(__('setting::mail.smtp.encryption'))
                    ->options([
                        '' => __('setting::mail.smtp.encryption_none'),
                        'ssl' => 'SSL',
                        'tls' => 'TLS',
                        'starttls' => 'STARTTLS',
                    ]),
            ]);
    }
}
