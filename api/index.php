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

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

// Redirect bootstrap cache to writable /tmp
$app->useStoragePath('/tmp/storage');
$app->bootstrapPath('/tmp/bootstrap');

$app->register(\Illuminate\View\ViewServiceProvider::class);
$app->register(\Illuminate\Routing\RoutingServiceProvider::class);

try {
    $app->handleRequest(Illuminate\Http\Request::capture());
} catch (\Throwable $e) {
    http_response_code(500);
    header('Content-Type: text/plain');
    echo get_class($e) . "\n" . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    if ($e->getPrevious()) {
        echo "\nCaused by: " . $e->getPrevious()->getMessage();
    }
}