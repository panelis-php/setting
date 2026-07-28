<?php

return [
    'sender' => 'Mail Sender',
    'from_address' => 'From address',
    'from_name' => 'From name',
    'section_description' => 'Configure how the application sends e-mails. Choose a mail driver such as Sendmail, Postmark, SES, or Log.',
    'driver' => 'Driver',
    'send_from' => 'Send from',
    'app_email' => 'App e-mail',
    'branch_email' => 'Branch e-mail',
    'branch_empty_help' => 'If you can\'t see any branches, that means no e-mail address has been set for each branch',
    'to_address' => 'To address',
    'test_success' => 'Test success',
    'test_instruction' => 'Please check your inbox or spam folder to make sure e-mail is received.',
    'test_failed' => 'Test failed',
    'label' => 'Mail',
    'navigation' => 'Mail',
    'test_content' => 'If you can see this e-mail, that\'s mean mail configuration set up correctly!',
    'test_subject' => 'Test mail!',
    'sender_section_description' => 'Name and e-mail will be used as the default identity when sending emails.',

    'cloudflare' => [
        'name' => 'Cloudflare',
        'description' => 'The Cloudflare e-mail setting allows your application to send emails using the Cloudflare email sending service',
        'account_id' => 'Account ID',
        'key' => 'Key',
        'no_package_title' => 'Cloudflare package not installed',
        'no_package_description' => 'Please install Cloudflare package using command: composer require symfony/http-client',
    ],

    'log' => [
        'name' => 'Log',
        'description' => 'This driver writes the e-mail messages to the application\'s log files instead of actually sending them.',
    ],

    'sendmail' => [
        'name' => 'Sendmail',
        'description' => 'The Sendmail e-mail setting allows your application to send emails using the built-in email sending program on your server',
        'path' => 'Path',
    ],

    'smtp' => [
        'name' => 'SMTP',
        'host' => 'Host',
        'port' => 'Port',
        'username' => 'Username',
        'password' => 'Password',
        'encryption' => 'Encryption',
        'encryption_none' => 'None',
        'description' => 'This driver uses the SMTP protocol to send e-mail messages through a mail server.',
    ],

    'mailgun' => [
        'name' => 'Mailgun',
        'domain' => 'Domain',
        'secret' => 'Secret',
        'endpoint' => 'Endpoint',
        'description' => 'This driver integrates with the Mailgun e-mail delivery service, allowing you to send email through their API.',
        'no_package_title' => 'Mailgun is not available',
        'no_package_description' => 'Please install Mailgun package using command: composer require symfony/mailgun-mailer symfony/http-client',
    ],

    'postmark' => [
        'name' => 'Postmark',
        'key' => 'Key',
        'description' => 'This driver integrates with the Postmark e-mail delivery service, providing a reliable and scalable way to send email.',
        'no_package_title' => 'Postmark is not available',
        'no_package_description' => 'Please install Postmark package using command: composer require symfony/postmark-mailer symfony/http-client',
    ],

    'resend' => [
        'name' => 'Resend',
        'key' => 'Key',
        'description' => 'This driver integrates with Resend to send developer-friendly transactional and marketing emails reliably.',
        'no_package_title' => 'Resend is not available',
        'no_package_description' => 'Please install Resend package using command: composer require resend/resend-laravel',
    ],

    'ses' => [
        'name' => 'Amazon SES',
        'key' => 'Key',
        'secret' => 'Secret',
        'region' => 'Region',
        'description' => 'This driver integrates with Amazon\'s Simple E-mail Service (SES), enabling you to send email through the AWS platform.',
        'no_package_title' => 'SES is not available',
        'no_package_description' => 'Please install SES package using command: composer require aws/aws-sdk-php',
    ],

    'email' => [
        'helper' => 'Test mail will be send to this address',
    ],

    'btn' => [
        'test_send' => 'Test send mail',
        'view_doc' => 'View documentation',
        'go_to_site' => 'Go to site',
    ],
];
