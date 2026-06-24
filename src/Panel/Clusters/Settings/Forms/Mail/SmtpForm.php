<?php

declare(strict_types=1);

namespace Panelis\Setting\Panel\Clusters\Settings\Forms\Mail;

use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Panelis\Setting\Panel\Clusters\Settings\Enums\MailType;

class SmtpForm
{
    public static function schema(): Section
    {
        $isDemo = config('panelis.demo');
        $demoText = function (): ?string {
            if (config('panelis.demo')) {
                return __('setting::setting.hidden_when_in_demo');
            }

            return null;
        };

        return Section::make(__('setting::setting.mail.smtp.driver'))
            ->visible(fn (Get $get): bool => $get('mail.default') === MailType::SMTP)
            ->schema([
                TextInput::make('mail.mailers.smtp.host')
                    ->label(__('setting::setting.mail.smtp.host'))
                    ->password($isDemo)
                    ->helperText($demoText)
                    ->required(),

                TextInput::make('mail.mailers.smtp.port')
                    ->label(__('setting::setting.mail.smtp.port'))
                    ->integer()
                    ->required(),

                TextInput::make('mail.mailers.smtp.username')
                    ->label(__('setting::setting.mail.smtp.username'))
                    ->password($isDemo)
                    ->helperText($demoText)
                    ->autocomplete(false)
                    ->nullable(),

                TextInput::make('mail.mailers.smtp.password')
                    ->label(__('setting::setting.mail.smtp.password'))
                    ->autocomplete(false)
                    ->password()
                    ->revealable()
                    ->nullable(),

                Radio::make('mail.mailers.smtp.encryption')
                    ->label(__('setting::setting.mail.smtp.encryption'))
                    ->options([
                        '' => __('setting::setting.mail.smtp.encryption_none'),
                        'ssl' => 'SSL',
                        'tls' => 'TLS',
                        'starttls' => 'STARTTLS',
                    ]),
            ]);
    }
}
