<?php

define('LARAVEL_START', microtime(true));

// Build required writable storage environments in /tmp
foreach ([
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
    '/tmp/storage/app',
    '/tmp/bootstrap/cache',
] as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// Map cache environment variables to /tmp explicitly
$_ENV['APP_PACKAGES_CACHE_PATH'] = '/tmp/bootstrap/cache/packages.php';
$_ENV['APP_SERVICES_CACHE_PATH'] = '/tmp/bootstrap/cache/services.php';
$_ENV['APP_CONFIG_CACHE_PATH'] = '/tmp/bootstrap/cache/config.php';
$_ENV['APP_ROUTES_CACHE_PATH'] = '/tmp/bootstrap/cache/routes.php';

putenv('APP_PACKAGES_CACHE_PATH=/tmp/bootstrap/cache/packages.php');
putenv('APP_SERVICES_CACHE_PATH=/tmp/bootstrap/cache/services.php');
putenv('APP_CONFIG_CACHE_PATH=/tmp/bootstrap/cache/config.php');
putenv('APP_ROUTES_CACHE_PATH=/tmp/bootstrap/cache/routes.php');

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$app->useStoragePath('/tmp/storage');

// ─── OPTIMIZED RECOVERY FIX ───
// Force-register only the native, standard view service core package
$app->register(\Illuminate\View\ViewServiceProvider::class);
// ──────────────────────────────

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Illuminate\Http\Request::capture();
$response = $kernel->handle($request);

$response->send();

$kernel->terminate($request, $response);