<?php

namespace Panelis\Setting\Panel\Clusters\Settings\Enums;

use Filament\Support\Contracts\HasLabel;
use Panelis\Setting\Panel\Clusters\Settings\Enums\Concerns\HasPermissionLabel;

enum SettingPermission: string implements HasLabel
{
    use HasPermissionLabel;

    case Browse = 'BrowseSetting';

    case Edit = 'EditSetting';

    case Export = 'ExportSetting';

    case Import = 'ImportSetting';
}
