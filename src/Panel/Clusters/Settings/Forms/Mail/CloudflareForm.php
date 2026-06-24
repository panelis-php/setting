<?php

declare(strict_types=1);

namespace Panelis\Setting\Panel\Clusters\Settings\Forms\Mail;

use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Callout;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Panelis\Setting\Panel\Clusters\Settings\Enums\MailType;

class CloudflareForm
{
    public static function schema(string $version): Section
    {
        return Section::make(__('setting::setting.mail.cloudflare.driver'))
            ->visible(fn (Get $get): bool => $get('mail.default') === MailType::Cloudflare)
            ->disabled(! MailType::Cloudflare->installed())
            ->description(__('setting::setting.mail.cloudflare.description'))
            ->schema([
                Callout::make(__('setting::setting.mail.cloudflare.no_package_title'))
                    ->description(__('setting::setting.mail.cloudflare.no_package_description'))
                    ->visible(! MailType::Cloudflare->installed())
                    ->warning()
                    ->actions([
                        Action::make('veiw_doc')
                            ->label(__('setting::setting.mail.btn.view_doc'))
                            ->url(sprintf('https://laravel.com/docs/%s.x/mail#cloudflare-driver', $version)),
                    ]),

                TextInput::make('services.cloudflare.account_id')
                    ->label(__('setting::setting.mail.cloudflare.account_id'))
                    ->required(),

                TextInput::make('services.cloudflare.key')
                    ->label(__('setting::setting.mail.cloudflare.key'))
                    ->password()
                    ->revealable()
                    ->required(),
            ]);
    }
}
