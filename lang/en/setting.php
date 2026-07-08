<?php

return [
    'label' => 'Settings',
    'key' => 'Key',
    'value' => 'Value',
    'navigation' => 'Settings',
    'hidden_when_in_demo' => 'This field is hidden in demo mode',

    'general' => [
        'url' => 'URL',
        'brand' => 'Brand',
        'description' => 'Description',
        'available_locales' => 'Available locales',
        'locale_list_hint' => '[List of ISO-639 codes](https://en.wikipedia.org/wiki/List_of_ISO_639_language_codes)',
        'default_locale' => 'Default locale',
        'email' => 'E-mail',
        'email_as_sender' => 'Use e-mail address as sender address in e-mail',
        'app_debug_enabled' => 'App debug enabled',
        'telescope_enabled' => 'Telescope enabled',
        'exported_file' => 'Exported file',
        'setting_imported' => 'Setting imported',
        'setting_not_imported' => 'Setting not imported',
        'label' => 'General',
        'navigation' => 'General',
        'section_description' => 'Manage basic application information such as the app name, description, logo, default language, and contact e-mail.',
        'debug_mode' => 'Debug Mode',
        'image' => 'Logo & Favicon',
        'section_image' => 'Manage the application logo and favicon used for branding and browser display.',
        'use_logo_in_panel' => 'Use logo in admin panel',
        'logo' => 'Logo',
        'favicon' => 'Favicon',
    ],

    'helper_app_debug' => 'It\'s recommended to disable this feature when in production mode.',
    'nightwatch_enabled' => 'Nightwatch enabled',
    'nightwatch_token' => 'Token',
    'nightwatch_server' => 'Server',
    'nightwatch_sampling' => 'Sampling',
    'nightwatch_sampling_requests' => 'Samping requests',
    'nightwatch_sampling_commands' => 'Sampling commands',
    'nightwatch_sampling_exceptions' => 'Samping exceptions',

    'number' => [
        'label' => 'Number',
        'navigation' => 'Number',
        'section_description' => 'Configure how numbers are formatted across the application, including decimal and thousand separators.',
        'currency_symbol' => 'Currency symbol',
        'currency_symbol_as_suffix' => 'Use symbol as suffix',
        'helper_currency_symbol_as_suffix' => 'When enabled, the symbol will be used behind the number',
        'format' => 'Format',
        'sample_display' => 'Sample display',
    ],

    'custom' => [
        'label' => 'Custom',
        'navigation' => 'Custom',
        'section_description' => 'Define custom configuration values. These can be used to override default Laravel settings or add new application-specific options.',
        'comment' => 'Comment',
        'placeholder_comment' => 'Add info about this setting',
        'updated' => 'Custom setting updated',
    ],

    'datetime' => [
        'label' => 'Date & Time',
        'navigation' => 'Date & Time',
        'section_description' => 'Configure the default date format and timezone used across the application.',
        'timezone' => 'Timezone',
        'format' => 'Format',
        'format_sample' => '[Click here for more format](https://www.php.net/manual/en/datetime.format.php)',
        'sample' => 'Sample display',
    ],

    'user' => [
        'label' => 'User',
        'navigation' => 'User',
        'default_role' => 'Default role',
        'avatar_provider' => 'Avatar provider',
        'avatar_libravatar_style' => 'Libravatar style',
        'section_description' => 'Manage user-related defaults, including the default role for new users and the avatar provider.',
    ],

    'panel' => [
        'label' => 'Panel',
        'navigation' => 'Panel',
        'section_description' => 'Configure how the admin panel is accessed, including its domain, path, and runtime behavior.',
        'enable_multitenant' => 'Enable multi-tenancy',
        'url' => 'URL',
        'path' => 'Path',
        'multitenant_helper' => 'When enabled, the admin panel runs in a tenant context. Resources can be scoped to the active tenant to isolate data between tenants.',
        'multitenant_hint' => '[Official documentation](https://filamentphp.com/docs/5.x/users/tenancy)',
    ],

    'theme' => [
        'navigation' => 'Theme',
        'label' => 'Theme',
        'section_description' => 'Customize the application’s appearance by selecting a theme, color scheme, or display mode.',
        'color_primary' => 'Primary',
        'color_gray' => 'Gray',
        'color_success' => 'Success',
        'color_danger' => 'Danger',
        'color_info' => 'Info',
        'color_warning' => 'Warning',
    ],

    'about' => [
        'label' => 'About',
        'navigation' => 'About',
        'php_version' => 'PHP version',
        'laravel_version' => 'Laravel version',
        'filament_version' => 'Filament version',
        'database_version' => 'Database version',
    ],

    'notifications' => [
        'updated' => [
            'title' => 'Setting updated',
        ],

        'update_failed' => [
            'title' => 'Failed to save setting',
        ],
    ],
];
