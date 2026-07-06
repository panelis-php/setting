<?php

namespace Panelis\Setting\Drivers\Mail;

use Composer\InstalledVersions;
use Filament\Schemas\Components\Section;
use Panelis\Setting\Drivers\MailDriver;
use Panelis\Setting\Panel\Clusters\Settings\Forms\Mail\MailgunForm;

class MailgunDriver extends MailDriver
{
    const string NAME = 'mailgun';

    public function name(): string
    {
        return self::NAME;
    }

    public function label(): string
    {
        return __('setting::mail.mailgun.name');
    }

    public function description(): ?string
    {
        return __('setting::mail.mailgun.description');
    }

    public function installed(): bool
    {
        return InstalledVersions::isInstalled('symfony/mailgun-mailer') && InstalledVersions::isInstalled('symfony/http-client');
    }

    public function schema(): ?Section
    {
        return MailgunForm::schema($this->version());
    }
}
