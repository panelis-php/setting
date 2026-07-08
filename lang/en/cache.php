<?php

return [
    'test_success' => 'Test success',
    'test_failed' => 'Test failed',
    'flushed' => 'Cache flushed',
    'section_description' => 'Configure the cache storage used by the application. Supported drivers include File, Database, Memcached, APC, Redis, and DynamoDB.',
    'driver' => 'Driver',
    'label' => 'Cache',
    'navigation' => 'Cache',

    'array' => [
        'label' => 'Array',
        'description' => 'Store cached data in memory for the duration of the current request',
    ],

    'file' => [
        'label' => 'File',
        'description' => 'Caching to the local file system',
    ],

    'database' => [
        'label' => 'Database',
        'description' => 'Storing cache in a :db database table',
    ],

    'memcached' => [
        'label' => 'Memcached',
        'description' => 'Distributed in-memory caching',
        'host' => 'Host',
        'port' => 'Port',
        'username' => 'Username',
        'password' => 'Password',
    ],

    'redis' => [
        'label' => 'Redis',
        'description' => 'Advanced in-memory data structure store',
        'host' => 'Host',
        'port' => 'Port',
        'database' => 'Database',
        'username' => 'Username',
        'password' => 'Password',
    ],

    'dynamodb' => [
        'label' => 'DynamoDB',
        'description' => 'AWS\'s scalable NoSQL database service',
        'key' => 'Key',
        'secret' => 'Secret',
        'region' => 'Region',
        'table' => 'Table',
        'endpoint' => 'Endpoint',
        'no_package_title' => 'DynamoDB is not available',
        'no_package_description' => 'Please install AWS SDK package using command: composer require aws/aws-sdk-php',
    ],

    'storage' => [
        'label' => 'Storage',
        'description' => 'Filesystem-based cache store using the :disk storage disk',
    ],

    'failover' => [
        'label' => 'Failover',
        'description' => '',
    ],

    'btn' => [
        'test' => 'Test cache',
        'flush' => 'Flush all',
    ],
];
