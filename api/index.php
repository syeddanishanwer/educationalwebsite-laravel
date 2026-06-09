<?php

define('LARAVEL_START', microtime(true));

// Calculate the absolute application root path
$appRoot = dirname(__DIR__);

// Create writable directory frameworks in /tmp for the Vercel read-only system
$directories = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
    '/tmp/storage/app',
];

foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// Register the standard Composer automated script loader
require $appRoot . '/vendor/autoload.php';

// Instantiate and boot the native core Laravel Application instance
$app = require_once $appRoot . '/bootstrap/app.php';

// Dynamically bind the framework storage paths to the writable /tmp block
$app->useStoragePath('/tmp/storage');

// Handle the incoming web request through the standard HTTP kernel layer
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);