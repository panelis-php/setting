<?php

declare(strict_types=1);

namespace Panelis\Setting\Panel\Clusters\Settings\Forms\Mail;

use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Callout;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Panelis\Setting\Panel\Clusters\Settings\Enums\MailType;

class PostmarkForm
{
    public static function schema(string $version): Section
    {
        return Section::make(__('setting::setting.mail.postmark.driver'))
            ->visible(fn (Get $get): bool => $get('mail.default') === MailType::Postmark)
            ->disabled(! MailType::Postmark->installed())
            ->schema([
                Callout::make(__('setting::setting.mail.postmark.no_package_title'))
                    ->description(__('setting::setting.mail.postmark.no_package_description'))
                    ->visible(! MailType::Postmark->installed())
                    ->warning()
                    ->actions([
                        Action::make('view_doc')
                            ->label(__('setting::setting.mail.btn.view_doc'))
                            ->url(sprintf('https://laravel.com/docs/%s.x/mail#postmark-driver', $version)),
                    ]),

                TextInput::make('services.postmark.key')
                    ->label(__('setting::setting.mail.postmark.key'))
                    ->password()
                    ->revealable()
                    ->required(),
            ]);
    }
}
