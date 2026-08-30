<?php

namespace Panelis\Setting\Panel\Clusters\Settings\Enums;

use Filament\Support\Contracts\HasLabel;
use Panelis\Setting\Panel\Clusters\Settings\Enums\Concerns\HasPermissionLabel;

enum CachePermission: string implements HasLabel
{
    use HasPermissionLabel;

    case Browse = 'BrowseCacheSetting';

    case Edit = 'EditCacheSetting';

    case Flush = 'FlushCacheSetting';
}
