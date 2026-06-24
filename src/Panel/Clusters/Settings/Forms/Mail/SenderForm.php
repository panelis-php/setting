<?php

declare(strict_types=1);

namespace Panelis\Setting\Panel\Clusters\Settings\Forms\Mail;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class SenderForm
{
    public static function schema(): Section
    {
        return Section::make(__('setting::setting.mail.sender'))
            ->description(__('setting::setting.mail.sender_section_description'))
            ->collapsed()
            ->schema([
                TextInput::make('mail.from.address')
                    ->label(__('setting::setting.mail.from_address'))
                    ->email()
                    ->required(),

                TextInput::make('mail.from.name')
                    ->label(__('setting::setting.mail.from_name'))
                    ->string()
                    ->required(),
            ]);
    }
}
