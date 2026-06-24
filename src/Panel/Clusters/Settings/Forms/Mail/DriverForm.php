<?php

declare(strict_types=1);

namespace Panelis\Setting\Panel\Clusters\Settings\Forms\Mail;

use Filament\Forms\Components\Radio;
use Filament\Schemas\Components\Section;
use Panelis\Setting\Panel\Clusters\Settings\Enums\MailType;

class DriverForm
{
    public static function schema(): Section
    {
        return Section::make(__('setting::setting.mail.label'))
            ->description(__('setting::setting.mail.section_description'))
            ->schema([
                Radio::make('mail.default')
                    ->label(__('setting::setting.mail.driver'))
                    ->options(MailType::class)
                    ->enum(MailType::class)
                    ->live()
                    ->required(),
            ]);
    }
}
