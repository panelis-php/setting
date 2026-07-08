<?php

return [
    'label' => 'Log',
    'navigation' => 'Log',
    'section_description' => 'Configure the logging channel used by the application, such as single, daily, or third-party services like Slack or Nightwatch.',
    'enable_notification' => 'Enable notification',
    'notification_helper' => 'When enabled, system errors will be sent as notifications to the dashboard.',
    'send_as_notification' => 'Send and view as notification',
    'test_sent' => 'Log test has been sent',
    'message' => 'Message',
    'channel' => 'Channel',
    'path' => 'Path',
    'slack_webhook_url' => 'Webhook URL',
    'slack_webhook_hint' => '[More info abount webhook](https://api.slack.com/messaging/webhooks)',
    'slack_username' => 'Username',
    'level_debug' => 'Debug',
    'level_info' => 'Info',
    'level_notice' => 'Notice',
    'level_warning' => 'Warning',
    'level_error' => 'Error',
    'level_critical' => 'Critical',
    'level_alert' => 'Alert',
    'level_emergency' => 'Emergency',
    'level' => 'Level',

    'daily' => [
        'label' => 'Daily',
        'description' => 'This driver logs all messages to a single log file.',
    ],

    'errorlog' => [
        'label' => 'Errorlog',
        'description' => 'This driver sends log messages to the PHP error log.',
    ],

    'monolog' => [
        'label' => 'Monolog',
        'description' => 'This driver uses the Monolog logging library, which provides a wide range of log handlers and is highly customizable.',
    ],

    'papertrail' => [
        'label' => 'Papertrail',
        'description' => 'This driver sends log messages to the Papertrail cloud-based log management service.',
        'url' => 'URL',
        'port' => 'Port',
    ],

    'single' => [
        'label' => 'Single',
        'description' => 'This driver logs all messages to a single log file.',
    ],

    'slack' => [
        'label' => 'Slack',
        'description' => 'This driver sends log messages as notifications to a Slack channel.',
    ],

    'syslog' => [
        'label' => 'Syslog',
        'description' => 'This driver sends log messages to the system\'s syslog facility.',
    ],

    'btn' => [
        'test' => 'Test log',
    ],
];
