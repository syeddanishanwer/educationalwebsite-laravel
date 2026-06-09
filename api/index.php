<?php

define('LARAVEL_START', microtime(true));

// Create /tmp directories before anything
foreach ([
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
    '/tmp/storage/app',
] as $dir) {
    if (!is_dir($dir)) mkdir($dir, 0775, true);
}

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

// Pre-bind view service before kernel boots
$app->register(\Illuminate\View\ViewServiceProvider::class);

$app->handleRequest(Illuminate\Http\Request::capture());