<?php

namespace Panelis\Setting\Panel\Clusters\Settings\Enums;

use Filament\Support\Contracts\HasLabel;
use Panelis\Setting\Panel\Clusters\Settings\Enums\Concerns\HasPermissionLabel;

enum UserPermission: string implements HasLabel
{
    use HasPermissionLabel;

    case Browse = 'BrowseUserSetting';
    case Edit = 'EditUserSetting';
}
