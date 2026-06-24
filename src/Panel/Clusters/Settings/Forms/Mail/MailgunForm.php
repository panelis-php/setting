<?php

declare(strict_types=1);

namespace Panelis\Setting\Panel\Clusters\Settings\Forms\Mail;

use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Callout;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Panelis\Setting\Panel\Clusters\Settings\Enums\MailType;

class MailgunForm
{
    public static function schema(string $version): Section
    {
        return Section::make(__('setting::setting.mail.mailgun.driver'))
            ->visible(fn (Get $get): bool => $get('mail.default') === MailType::Mailgun)
            ->disabled(! MailType::Mailgun->installed())
            ->schema([
                Callout::make(__('setting::setting.mail.mailgun.no_package_title'))
                    ->description(__('setting::setting.mail.mailgun.no_package_description'))
                    ->visible(! MailType::Mailgun->installed())
                    ->warning()
                    ->actions([
                        Action::make('view_doc')
                            ->label(__('setting::setting.mail.btn.view_doc'))
                            ->url(sprintf('https://laravel.com/docs/%s.x/mail#mailgun-driver', $version)),
                    ]),

                TextInput::make('services.mailgun.domain')
                    ->label(__('setting::setting.mail.mailgun.domain'))
                    ->string()
                    ->required(),

                TextInput::make('services.mailgun.secret')
                    ->label(__('setting::setting.mail.mailgun.secret'))
                    ->password()
                    ->revealable()
                    ->required(),

                TextInput::make('services.mailgun.endpoint')
                    ->label(__('setting::setting.mail.mailgun.endpoint'))
                    ->string()
                    ->required(),
            ]);
    }
}
