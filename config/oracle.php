<?php

return [
    'sismiop' => [
        'driver' => 'oracle',
        'host' => env('DB_SISMIOP_HOST', ''),
        'port' => env('DB_SISMIOP_PORT', '1521'),
        'service_name' => env('DB_SISMIOP_SERVICE_NAME', ''),
        'username' => env('DB_SISMIOP_USERNAME', ''),
        'password' => env('DB_SISMIOP_PASSWORD', ''),
        'charset' => 'AL32UTF8',
        'prefix' => '',
        'prefix_schema' => '',
        'edition' => 'ora$base',
        'server_version' => '11g',
        'load_balance' => 'yes',
        'max_name_len' => 30,
        'dynamic' => [],
        'sessionVars' => [],
    ]
];
