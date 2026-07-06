<?php

namespace Panelis\Setting\Drivers\Mail;

use Filament\Schemas\Components\Section;
use Panelis\Setting\Drivers\MailDriver;
use Panelis\Setting\Panel\Clusters\Settings\Forms\Mail\SmtpForm;

class SmtpDriver extends MailDriver
{
    const string NAME = 'smtp';

    public function name(): string
    {
        return self::NAME;
    }

    public function label(): string
    {
        return __('setting::mail.smtp.name');
    }

    public function description(): ?string
    {
        return __('setting::mail.smtp.description');
    }

    public function schema(): ?Section
    {
        return SmtpForm::schema();
    }
}
