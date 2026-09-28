<?php
/**
 * Application configuration.
 *
 * Copy this file to `config.php` and adjust the values for your environment.
 * `config.php` is ignored by git, so your real credentials are never committed.
 * If `config.php` does not exist, these defaults are used (they match a stock XAMPP install).
 */

return [
    'db' => [
        'host' => 'localhost',
        'port' => 3306,
        'name' => 'attendance',
        'user' => 'root',
        'pass' => '',
    ],

    'timezone' => 'Asia/Kolkata',

    // Show PHP errors in the browser. Keep this false on any public server.
    'debug' => false,
];
