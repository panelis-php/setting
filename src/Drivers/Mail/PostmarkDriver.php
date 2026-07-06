<?php

namespace Panelis\Setting\Drivers\Mail;

use Composer\InstalledVersions;
use Filament\Schemas\Components\Section;
use Panelis\Setting\Drivers\MailDriver;
use Panelis\Setting\Panel\Clusters\Settings\Forms\Mail\PostmarkForm;

class PostmarkDriver extends MailDriver
{
    const string NAME = 'postmark';

    public function name(): string
    {
        return self::NAME;
    }

    public function label(): string
    {
        return __('setting::mail.postmark.name');
    }

    public function description(): ?string
    {
        return __('setting::mail.postmark.description');
    }

    public function installed(): bool
    {
        return InstalledVersions::isInstalled('symfony/postmark-mailer') && InstalledVersions::isInstalled('symfony/http-client');
    }

    public function schema(): ?Section
    {
        return PostmarkForm::schema($this->version());
    }
}
