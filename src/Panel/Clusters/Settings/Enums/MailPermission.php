<?php

namespace Panelis\Setting\Panel\Clusters\Settings\Enums;

use Filament\Support\Contracts\HasLabel;
use Panelis\Setting\Panel\Clusters\Settings\Enums\Concerns\HasPermissionLabel;

enum MailPermission: string implements HasLabel
{
    use HasPermissionLabel;

    case Browse = 'BrowseMailSetting';

    case Edit = 'EditMailSetting';

    case SendTest = 'SendTestMailSetting';
}
