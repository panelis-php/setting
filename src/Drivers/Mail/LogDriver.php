<?php

namespace Panelis\Setting\Drivers\Mail;

use Panelis\Setting\Drivers\MailDriver;

class LogDriver extends MailDriver
{
    const string NAME = 'log';

    public function name(): string
    {
        return self::NAME;
    }

    public function label(): string
    {
        return __('setting::mail.log.name');
    }

    public function description(): ?string
    {
        return __('setting::mail.log.description');
    }
}
