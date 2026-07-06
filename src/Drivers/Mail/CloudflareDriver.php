<?php

namespace Panelis\Setting\Drivers\Mail;

use Composer\InstalledVersions;
use Filament\Schemas\Components\Section;
use Panelis\Setting\Drivers\MailDriver;
use Panelis\Setting\Panel\Clusters\Settings\Forms\Mail\CloudflareForm;

class CloudflareDriver extends MailDriver
{
    const string NAME = 'cloudflare';

    public function name(): string
    {
        return self::NAME;
    }

    public function label(): string
    {
        return __('setting::mail.cloudflare.name');
    }

    public function description(): ?string
    {
        return __('setting::mail.cloudflare.description');
    }

    public function installed(): bool
    {
        return InstalledVersions::isInstalled('symfony/http-client');
    }

    public function schema(): ?Section
    {
        return CloudflareForm::schema($this->version());
    }
}
