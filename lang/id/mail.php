<?php

return [
    'sender' => 'Pengirim',
    'from_address' => 'Alamat pengirim',
    'from_name' => 'Nama pengirim',
    'section_description' => 'Atur cara aplikasi mengirim pos-el. Pilih driver mail seperti Sendmail, Postmark, SES, atau Log.',
    'driver' => 'Driver',
    'send_from' => 'Kirim dari',
    'app_email' => 'Pos-el aplikasi',
    'branch_email' => 'Pos-el cabang',
    'branch_empty_help' => 'Jika tidak ada cabang yang terlihat, berarti belum ada alamat pos-el yang ditetapkan untuk setiap cabang',
    'to_address' => 'Alamat tujuan',
    'test_success' => 'Ujicoba berhasil',
    'test_instruction' => 'Periksa kotak masuk atau folder spam untuk memastikan pos-el diterima.',
    'test_failed' => 'Ujicoba gagal',
    'label' => 'Mail',
    'navigation' => 'Mail',
    'test_content' => 'Jika Anda dapat melihat pos-el ini, berarti konfigurasi mail sudah benar!',
    'test_subject' => 'Pos-el uji!',
    'sender_section_description' => 'Nama dan pos-el akan digunakan sebagai identitas default saat mengirim pos-el.',

    'cloudflare' => [
        'name' => 'Cloudflare',
        'description' => 'Pengaturan pos-el Cloudflare memungkinkan aplikasi mengirim pos-el menggunakan layanan pengiriman pos-el Cloudflare.',
        'account_id' => 'ID akun',
        'key' => 'Key',
        'no_package_title' => 'Package Cloudflare belum terpasang',
        'no_package_description' => 'Instal package Cloudflare dengan perintah: composer require symfony/http-client',
    ],

    'log' => [
        'name' => 'Log',
        'description' => 'Driver ini menulis pesan pos-el ke berkas log aplikasi, bukan benar-benar mengirimkannya.',
    ],

    'sendmail' => [
        'name' => 'Sendmail',
        'description' => 'Pengaturan pos-el Sendmail memungkinkan aplikasi mengirim pos-el menggunakan program pos-el bawaan server.',
        'path' => 'Path',
    ],

    'smtp' => [
        'name' => 'SMTP',
        'host' => 'Host',
        'port' => 'Port',
        'username' => 'Nama pengguna',
        'password' => 'Kata sandi',
        'encryption' => 'Enkripsi',
        'encryption_none' => 'Tidak ada',
        'description' => 'Driver ini menggunakan protokol SMTP untuk mengirim pos-el melalui server mail.',
    ],

    'mailgun' => [
        'name' => 'Mailgun',
        'domain' => 'Domain',
        'secret' => 'Secret',
        'endpoint' => 'Endpoint',
        'description' => 'Driver ini terintegrasi dengan layanan pengiriman pos-el Mailgun melalui API mereka.',
        'no_package_title' => 'Mailgun tidak tersedia',
        'no_package_description' => 'Instal package Mailgun dengan perintah: composer require symfony/mailgun-mailer symfony/http-client',
    ],

    'postmark' => [
        'name' => 'Postmark',
        'key' => 'Key',
        'description' => 'Driver ini terintegrasi dengan layanan pengiriman pos-el Postmark.',
        'no_package_title' => 'Postmark tidak tersedia',
        'no_package_description' => 'Instal package Postmark dengan perintah: composer require symfony/postmark-mailer symfony/http-client',
    ],

    'resend' => [
        'name' => 'Resend',
        'key' => 'Key',
        'description' => 'Driver ini terintegrasi dengan Resend untuk mengirim pos-el transaksional dan pemasaran.',
        'no_package_title' => 'Resend tidak tersedia',
        'no_package_description' => 'Instal package Resend dengan perintah: composer require resend/resend-laravel',
    ],

    'ses' => [
        'name' => 'Amazon SES',
        'key' => 'Key',
        'secret' => 'Secret',
        'region' => 'Region',
        'description' => 'Driver ini terintegrasi dengan Amazon Simple Email Service (SES) melalui AWS.',
        'no_package_title' => 'SES tidak tersedia',
        'no_package_description' => 'Instal package SES dengan perintah: composer require aws/aws-sdk-php',
    ],

    'email' => [
        'helper' => 'Pos-el ujicoba akan dikirim ke alamat ini',
    ],

    'btn' => [
        'test_send' => 'Kirim pos-el ujicoba',
        'view_doc' => 'Lihat dokumentasi',
        'go_to_site' => 'Buka situs',
    ],
];
