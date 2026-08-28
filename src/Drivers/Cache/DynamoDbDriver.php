<?php

namespace Panelis\Setting\Drivers\Cache;

use Composer\InstalledVersions;
use Filament\Schemas\Components\Section;
use Panelis\Setting\Drivers\CacheDriver;
use Panelis\Setting\Panel\Clusters\Settings\Forms\Cache\DynamoDbForm;

class DynamoDbDriver extends CacheDriver
{
    public const string NAME = 'dynamodb';

    public function name(): string
    {
        return self::NAME;
    }

    public function label(): string
    {
        return __('setting::cache.dynamodb.label');
    }

    public function description(): string
    {
        return __('setting::cache.dynamodb.description');
    }

    public function installed(): bool
    {
        return InstalledVersions::isInstalled('aws/aws-sdk-php');
    }

    public function schema(): ?Section
    {
        return DynamoDbForm::schema();
    }
}
