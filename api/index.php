<?php

define('LARAVEL_START', microtime(true));

// Create required /tmp directories BEFORE Laravel boots
$directories = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
    '/tmp/storage/app/public',
];

foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0775, true);
    }
}

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$app->handleRequest(Illuminate\Http\Request::capture());