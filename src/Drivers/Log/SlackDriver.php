<?php

namespace Panelis\Setting\Drivers\Log;

use Filament\Schemas\Components\Section;
use Panelis\Setting\Drivers\LogDriver;
use Panelis\Setting\Panel\Clusters\Settings\Forms\Log\SlackForm;

class SlackDriver extends LogDriver
{
    public const string NAME = 'slack';

    public function name(): string
    {
        return self::NAME;
    }

    public function label(): string
    {
        return __('setting::log.slack.label');
    }

    public function description(): ?string
    {
        return __('setting::log.slack.description');
    }

    public function schema(): ?Section
    {
        return SlackForm::schema();
    }
}
