<?php

namespace Panelis\Setting\Drivers\Mail;

use Composer\InstalledVersions;
use Filament\Schemas\Components\Section;
use Panelis\Setting\Drivers\MailDriver;
use Panelis\Setting\Panel\Clusters\Settings\Forms\Mail\ResendForm;

class ResendDriver extends MailDriver
{
    const string NAME = 'resend';

    public function name(): string
    {
        return self::NAME;
    }

    public function label(): string
    {
        return __('setting::mail.resend.name');
    }

    public function description(): ?string
    {
        return __('setting::mail.resend.description');
    }

    public function installed(): bool
    {
        return InstalledVersions::isInstalled('resend/resend-laravel');
    }

    public function schema(): ?Section
    {
        return ResendForm::schema($this->version());
    }
}
