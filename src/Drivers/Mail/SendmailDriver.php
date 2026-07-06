<?php

namespace Panelis\Setting\Drivers\Mail;

use Filament\Schemas\Components\Section;
use Panelis\Setting\Drivers\MailDriver;
use Panelis\Setting\Panel\Clusters\Settings\Forms\Mail\SendmailForm;

class SendmailDriver extends MailDriver
{
    const string NAME = 'sendmail';

    public function name(): string
    {
        return self::NAME;
    }

    public function label(): string
    {
        return __('setting::mail.sendmail.name');
    }

    public function description(): ?string
    {
        return __('setting::mail.sendmail.description');
    }

    public function schema(): ?Section
    {
        return SendmailForm::schema();
    }
}
