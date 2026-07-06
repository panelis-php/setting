<?php

namespace Panelis\Setting\Drivers;

use Filament\Schemas\Components\Section;

abstract class Driver
{
    abstract public function name(): string;

    abstract public function label(): string;

    public function version(): string
    {
        return array_first(explode('.', app()->version())) ?? '13';
    }

    public function description(): ?string
    {
        return null;
    }

    public function installed(): bool
    {
        return true;
    }

    public function schema(): ?Section
    {
        return null;
    }

    public function sort(): int
    {
        return 0;
    }
}
