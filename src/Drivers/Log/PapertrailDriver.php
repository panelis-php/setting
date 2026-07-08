<?php

namespace Panelis\Setting\Drivers\Log;

use Filament\Schemas\Components\Section;
use Panelis\Setting\Drivers\LogDriver;
use Panelis\Setting\Panel\Clusters\Settings\Forms\Log\PapertrailForm;

class PapertrailDriver extends LogDriver
{
    public const string NAME = 'papertrail';

    public function name(): string
    {
        return self::NAME;
    }

    public function label(): string
    {
        return __('setting::log.papertrail.label');
    }

    public function description(): ?string
    {
        return __('setting::log.papertrail.description');
    }

    public function schema(): ?Section
    {
        return PapertrailForm::schema();
    }
}
