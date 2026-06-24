<?php

declare(strict_types=1);

namespace Panelis\Setting\Plugins;

use Filament\Contracts\Plugin;
use Filament\Panel;

class SettingPlugin implements Plugin
{
    public function getId(): string
    {
        return 'setting';
    }

    public function register(Panel $panel): void
    {
        $panel->discoverClusters(__DIR__.'/../Panel/Clusters', 'Panelis\\Setting\\Panel\\Clusters');
    }

    public function boot(Panel $panel): void {}
}
