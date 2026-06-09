<?php

define('LARAVEL_START', microtime(true));

// Ensure required writable storage and bootstrap paths exist in /tmp
$directories = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
    '/tmp/storage/app',
    '/tmp/bootstrap/cache',
];

foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// FORCE Laravel to route framework tracking manifests into the writable /tmp volume
$_ENV['APP_PACKAGES_CACHE_PATH'] = '/tmp/bootstrap/cache/packages.php';
$_ENV['APP_SERVICES_CACHE_PATH'] = '/tmp/bootstrap/cache/services.php';
$_ENV['APP_CONFIG_CACHE_PATH'] = '/tmp/bootstrap/cache/config.php';
$_ENV['APP_ROUTES_CACHE_PATH'] = '/tmp/bootstrap/cache/routes.php';

putenv('APP_PACKAGES_CACHE_PATH=/tmp/bootstrap/cache/packages.php');
putenv('APP_SERVICES_CACHE_PATH=/tmp/bootstrap/cache/services.php');
putenv('APP_CONFIG_CACHE_PATH=/tmp/bootstrap/cache/config.php');
putenv('APP_ROUTES_CACHE_PATH=/tmp/bootstrap/cache/routes.php');

// Register Composer's autoloader
require __DIR__ . '/../vendor/autoload.php';

// Boot the native application matrix
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Direct storage paths to the writable /tmp volume
$app->useStoragePath('/tmp/storage');

// Process the incoming request through the standard framework HTTP kernel
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);