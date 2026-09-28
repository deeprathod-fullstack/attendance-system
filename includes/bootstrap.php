<?php
/**
 * Loaded at the top of every page: configuration, error handling, session and helpers.
 */

declare(strict_types=1);

define('APP_ROOT', dirname(__DIR__));
define('UPLOAD_DIR', APP_ROOT . '/admin/upload');
define('MAX_UPLOAD_BYTES', 2 * 1024 * 1024);

$configFile = is_file(APP_ROOT . '/config.php') ? APP_ROOT . '/config.php' : APP_ROOT . '/config.example.php';
$GLOBALS['config'] = require $configFile;

error_reporting(E_ALL);
ini_set('display_errors', $GLOBALS['config']['debug'] ? '1' : '0');
date_default_timezone_set($GLOBALS['config']['timezone']);

if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_httponly' => true,
        'cookie_samesite' => 'Lax',
        'use_strict_mode' => true,
    ]);
}

require __DIR__ . '/database.php';
require __DIR__ . '/helpers.php';
require __DIR__ . '/auth.php';
