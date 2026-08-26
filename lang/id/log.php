<?php

return [
    'label' => 'Log',
    'navigation' => 'Log',
    'section_description' => 'Konfigurasikan kanal log yang digunakan aplikasi, seperti tunggal, harian, atau layanan pihak ketiga seperti Slack atau Papertrail.',
    'enable_notification' => 'Aktifkan notifikasi',
    'notification_helper' => 'Jika diaktifkan, error sistem akan dikirim sebagai notifikasi ke dashboard.',
    'send_as_notification' => 'Kirim dan tampilkan sebagai notifikasi',
    'test_sent' => 'Log ujicoba berhasil dikirim',
    'message' => 'Pesan',
    'channel' => 'Kanal',
    'path' => 'Path',
    'slack_webhook_url' => 'URL Webhook',
    'slack_webhook_hint' => '[Info lebih lanjut tentang webhook](https://api.slack.com/messaging/webhooks)',
    'slack_username' => 'Nama pengguna',
    'level_debug' => 'Debug',
    'level_info' => 'Info',
    'level_notice' => 'Pemberitahuan',
    'level_warning' => 'Peringatan',
    'level_error' => 'Galat',
    'level_critical' => 'Kritis',
    'level_alert' => 'Waspada',
    'level_emergency' => 'Darurat',
    'level' => 'Level',

    'daily' => [
        'label' => 'Harian',
        'description' => 'Driver ini mencatat semua pesan ke berkas log baru setiap hari.',
    ],

    'errorlog' => [
        'label' => 'Errorlog',
        'description' => 'Driver ini mengirim pesan log ke error log PHP.',
    ],

    'monolog' => [
        'label' => 'Monolog',
        'description' => 'Driver ini menggunakan library logging Monolog yang menyediakan berbagai handler log dan dapat dikustomisasi.',
    ],

    'monthly' => [
        'label' => 'Bulanan',
        'description' => 'Driver ini mencatat pesan ke berkas log baru setiap bulan dan menyimpan sejumlah berkas bulanan.',
    ],

    'papertrail' => [
        'label' => 'Papertrail',
        'description' => 'Driver ini mengirim pesan log ke layanan manajemen log berbasis cloud Papertrail.',
        'url' => 'URL',
        'port' => 'Port',
    ],

    'single' => [
        'label' => 'Single',
        'description' => 'Driver ini mencatat semua pesan ke satu berkas log.',
    ],

    'slack' => [
        'label' => 'Slack',
        'description' => 'Driver ini mengirim pesan log sebagai notifikasi ke channel Slack.',
    ],

    'syslog' => [
        'label' => 'Syslog',
        'description' => 'Driver ini mengirim pesan log ke fasilitas syslog sistem.',
    ],

    'btn' => [
        'test' => 'Ujicoba log',
    ],
];
