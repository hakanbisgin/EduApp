<?php
return [
    'name' => 'EduApp',
    'pepper' => env('PEPPER', 'mySecretPepper'),
    'database' => [
        'host' => env('DB_HOST', 'localhost'),
        'name' => env('DB_NAME', 'myDB'),
        'username' => env('DB_USERNAME', 'username'),
        'password' => env('DB_PASSWORD', '')
    ]
];