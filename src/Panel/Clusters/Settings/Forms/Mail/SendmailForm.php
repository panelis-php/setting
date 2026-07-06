<?php

declare(strict_types=1);

namespace Panelis\Setting\Panel\Clusters\Settings\Forms\Mail;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Panelis\Setting\Drivers\Mail\SendmailDriver;

class SendmailForm
{
    public static function schema(): Section
    {
        return Section::make(__('setting::mail.sendmail.name'))
            ->visible(fn (Get $get): bool => $get('mail.default') === SendmailDriver::NAME)
            ->schema([
                TextInput::make('mail.mailers.sendmail.path')
                    ->label(__('setting::mail.sendmail.path'))
                    ->required(),
            ]);
    }
}
