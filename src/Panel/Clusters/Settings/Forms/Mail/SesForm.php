<?php

declare(strict_types=1);

namespace Panelis\Setting\Panel\Clusters\Settings\Forms\Mail;

use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Callout;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Panelis\Setting\Panel\Clusters\Settings\Enums\MailType;

class SesForm
{
    public static function schema(string $version): Section
    {
        return Section::make(__('setting::setting.mail.ses.driver'))
            ->visible(fn (Get $get): bool => $get('mail.default') === MailType::SES)
            ->disabled(! MailType::SES->installed())
            ->schema([
                Callout::make(__('setting::setting.mail.ses.no_package_title'))
                    ->description(__('setting::setting.mail.ses.no_package_description'))
                    ->visible(! MailType::SES->installed())
                    ->warning()
                    ->actions([
                        Action::make('view_doc')
                            ->label(__('setting::setting.mail.btn.view_doc'))
                            ->url(sprintf('https://laravel.com/docs/%s.x/mail#ses-driver', $version)),
                    ]),

                TextInput::make('services.ses.key')
                    ->label(__('setting::setting.mail.ses.key'))
                    ->required(),

                TextInput::make('services.ses.secret')
                    ->label(__('setting::setting.mail.ses.secret'))
                    ->password()
                    ->revealable()
                    ->required(),

                TextInput::make('services.ses.region')
                    ->label(__('setting::setting.mail.ses.region'))
                    ->required(),
            ]);
    }
}
