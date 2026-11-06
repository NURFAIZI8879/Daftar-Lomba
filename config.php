<?php

$config = [
    'database' => [
        'host' => getenv('DB_HOST') ?: 'localhost',
        'port' => getenv('DB_PORT') ?: 3306,
        'dbname' => getenv('DB_NAME') ?: 'tiketit',
        'charset' => 'utf8mb4',
        'username' => getenv('DB_USER') ?: 'root',
        'password' => getenv('DB_PASS') ?: '',
    ],
    'app' => [
        'name' => 'TiketIT',
        'version' => '1.0.0',
        'timezone' => 'Asia/Jakarta',
    ],
];

// Allow a local (gitignored) override file for production credentials
$local = __DIR__ . '/config.local.php';
if (file_exists($local)) {
    $override = require $local;
    if (is_array($override)) {
        $config = array_replace_recursive($config, $override);
    }
}

return $config;
