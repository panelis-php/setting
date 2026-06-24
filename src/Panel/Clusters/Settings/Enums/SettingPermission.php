<?php

namespace Panelis\Setting\Panel\Clusters\Settings\Enums;

enum SettingPermission: string
{
    case Browse = 'BrowseSetting';

    case Edit = 'EditSetting';

    case Export = 'ExportSetting';

    case Import = 'ImportSetting';
}
