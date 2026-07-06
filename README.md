# Panelis Setting

Manage application settings directly from the Panelis admin panel.

## Features

* Centralized application settings
* Typed setting fields
* Setting groups and sections
* Automatic setting persistence
* Laravel cache integration
* Automatic Panelis plugin discovery

## Requirements

* PHP 8.3+
* Laravel 13+
* Filament 5+

## Installation

Install the package via Composer:

```bash id="8rhn6k"
composer require panelis-php/setting
```

Run migrations:

```bash id="grh3qb"
php artisan migrate
```

## Usage

After installation, a **Settings** menu will be available in the Panelis admin panel.

The Setting module provides a centralized location for managing application configuration without modifying environment variables or configuration files.

Common use cases include:

* Site name
* Site description
* Contact information
* Social media links
* Third-party service settings
* Application preferences

Settings are stored in the database and can be managed through customizable setting pages.

## Accessing Settings

Settings can be accessed throughout your application using the provided helper functions and services.

Example:

```php id="hcvv1f"
config('site.name');
```

## Extending Drivers

Panelis uses a driver-based architecture for configurable services such as Mail, Cache, and Log.

### Registering a Driver

Register a driver from your service provider.

```php
use Panelis\Setting\Drivers\DriverManager;

app(DriverManager::class)->register(
    new MailerSendDriver(),
);
```

The driver will automatically appear in the corresponding settings page.

---

## Creating a Mail Driver

Create a driver by extending `MailDriver`.

```php
use Panelis\Setting\Drivers\MailDriver;

class MailerSendDriver extends MailDriver
{
    public const NAME = 'mailersend';

    public function name(): string
    {
        return self::NAME;
    }

    public function label(): string
    {
        return 'MailerSend';
    }

    public function description(): ?string
    {
        return 'MailerSend API';
    }

    public function installed(): bool
    {
        return InstalledVersions::isInstalled(
            'mailersend/mailersend-laravel'
        );
    }

    public function schema(): ?Section
    {
        return MailerSendForm::schema();
    }
}
```

Once registered, the driver will automatically:

- Appear in the Mail driver list.
- Display its configuration section.
- Respect its installation status.
- Be sorted by `sort()` and `label()`.

---

## Creating Other Driver Types

The same mechanism can be used for other configurable services.

### Cache

```php
class RedisDriver extends CacheDriver
{
    public const NAME = 'redis';

    // ...
}
```

### Log

```php
class SlackDriver extends LogDriver
{
    public const NAME = 'slack';

    // ...
}
```

`DriverManager` automatically groups drivers by their base type, so Mail, Cache, and Log drivers remain isolated from each other.

## Integration

The Setting module can be used by other Panelis modules to store and manage module-specific configuration.

## License

The MIT License (MIT).
