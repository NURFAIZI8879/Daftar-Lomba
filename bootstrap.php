<?php

use Core\App;
use Core\Container;
use Core\Database;

$container = new Container();

$container->bind('Core\Database', function () {
    $config = require base_path('config.php');

    return new Database(
        $config['database'],
        $config['database']['username'] ?? 'root',
        $config['database']['password'] ?? ''
    );
});

App::setContainer($container);

// Error logging (production)
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', base_path('logs/error.log'));
// Don't display errors in production (set to 0)
ini_set('display_errors', 0);
