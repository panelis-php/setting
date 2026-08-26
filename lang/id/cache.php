<?php

return [
    'test_success' => 'Ujicoba berhasil',
    'test_failed' => 'Ujicoba gagal',
    'flushed' => 'Cache berhasil dikosongkan',
    'section_description' => 'Atur penyimpanan cache yang digunakan aplikasi. Driver yang didukung mencakup File, Database, Memcached, APC, Redis, dan DynamoDB.',
    'driver' => 'Driver',
    'label' => 'Cache',
    'navigation' => 'Cache',

    'array' => [
        'label' => 'Array',
        'description' => 'Menyimpan data cache di memori selama request berlangsung.',
    ],

    'file' => [
        'label' => 'File',
        'description' => 'Caching ke sistem file lokal.',
    ],

    'database' => [
        'label' => 'Database',
        'description' => 'Menyimpan cache di tabel database :db.',
    ],

    'memcached' => [
        'label' => 'Memcached',
        'description' => 'Caching terdistribusi di memori.',
        'host' => 'Host',
        'port' => 'Port',
        'username' => 'Nama pengguna',
        'password' => 'Kata sandi',
    ],
    'redis' => [
        'label' => 'Redis',
        'description' => 'Penyimpanan struktur data tingkat lanjut di memori.',
        'host' => 'Host',
        'port' => 'Port',
        'database' => 'Database',
        'username' => 'Nama pengguna',
        'password' => 'Kata sandi',
    ],

    'dynamodb' => [
        'label' => 'DynamoDB',
        'description' => 'Layanan database NoSQL AWS yang skalabel.',
        'key' => 'Key',
        'secret' => 'Secret',
        'region' => 'Region',
        'table' => 'Tabel',
        'endpoint' => 'Endpoint',
        'no_package_title' => 'DynamoDB tidak tersedia',
        'no_package_description' => 'Instal package AWS SDK dengan perintah: composer require aws/aws-sdk-php',
    ],

    'storage' => [
        'label' => 'Storage',
        'description' => 'Cache berbasis sistem file menggunakan disk penyimpanan ":disk".',
    ],

    'failover' => [
        'label' => 'Failover',
        'description' => '',
    ],

    'btn' => [
        'test' => 'Uji cache',
        'flush' => 'Kosongkan semua',
    ],
];
