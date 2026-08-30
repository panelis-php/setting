<?php

namespace Panelis\Setting\Panel\Clusters\Settings\Enums\Concerns;

use Illuminate\Support\Str;

trait HasPermissionLabel
{
    public function getLabel(): string
    {
        return __(sprintf('setting::permission.name_%s', Str::snake($this->value)));
    }
}
