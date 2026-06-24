<?php

namespace Panelis\Setting\Panel\Clusters\Settings\Enums;

use Composer\InstalledVersions;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasLabel;

enum CacheDriver: string implements HasDescription, HasLabel
{
    case File = 'file';

    case Database = 'database';

    case DynamoDB = 'dynamodb';

    case Memcached = 'memcached';

    case Redis = 'redis';

    case Storage = 'storage';

    public function getLabel(): string
    {
        return __(sprintf('setting::setting.cache.%s.label', $this->value));
    }

    public function getDescription(): string
    {
        return __(sprintf('setting::setting.cache.%s.description', $this->value));
    }

    public function isInstalled(): bool
    {
        return match ($this) {
            self::DynamoDB => InstalledVersions::isInstalled('aws/aws-sdk-php'),
            default => true,
        };
    }
}
