<?php

namespace Panelis\Setting\Drivers\Mail;

use Composer\InstalledVersions;
use Filament\Schemas\Components\Section;
use Panelis\Setting\Drivers\MailDriver;
use Panelis\Setting\Panel\Clusters\Settings\Forms\Mail\SesForm;

class SesDriver extends MailDriver
{
    const string NAME = 'ses';

    public function name(): string
    {
        return self::NAME;
    }

    public function label(): string
    {
        return __('setting::mail.ses.name');
    }

    public function description(): ?string
    {
        return __('setting::mail.ses.description');
    }

    public function installed(): bool
    {
        return InstalledVersions::isInstalled('aws/aws-sdk-php');
    }

    public function schema(): ?Section
    {
        return SesForm::schema($this->version());
    }
}
