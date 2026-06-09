<?php

define('LARAVEL_START', microtime(true));

foreach ([
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
    '/tmp/storage/app',
    '/tmp/bootstrap/cache',
] as $dir) {
    if (!is_dir($dir)) mkdir($dir, 0775, true);
}

// Copy bootstrap cache to writable /tmp
foreach (glob(__DIR__ . '/../bootstrap/cache/*.php') as $file) {
    $dest = '/tmp/bootstrap/cache/' . basename($file);
    if (!file_exists($dest)) copy($file, $dest);
}

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$app->useStoragePath('/tmp/storage');

$app->handleRequest(Illuminate\Http\Request::capture());