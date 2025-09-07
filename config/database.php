<?php

return [
    'driver'   => env('DB_DRIVER', 'mysql'),
    'host'     => env('DB_HOST', '127.0.0.1'),
    'port'     => env('DB_PORT', 3306),
    'database' => env('DB_DATABASE', 'devlog'),
    'charset'  => env('DB_CHARSET', 'utf8mb4'),
    'username' => env('DB_USERNAME', 'root'),
    'password' => env('DB_PASSWORD', 'password'),
];
