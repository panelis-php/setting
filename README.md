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
setting('site.name');
```

## Integration

The Setting module can be used by other Panelis modules to store and manage module-specific configuration.

## License

The MIT License (MIT).
