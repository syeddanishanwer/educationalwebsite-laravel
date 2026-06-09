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

// Force environment paths for the cache manifest volume targets
$_ENV['APP_PACKAGES_CACHE_PATH'] = '/tmp/bootstrap/cache/packages.php';
$_ENV['APP_SERVICES_CACHE_PATH'] = '/tmp/bootstrap/cache/services.php';
$_ENV['APP_CONFIG_CACHE_PATH'] = '/tmp/bootstrap/cache/config.php';
$_ENV['APP_ROUTES_CACHE_PATH'] = '/tmp/bootstrap/cache/routes.php';

putenv('APP_PACKAGES_CACHE_PATH=/tmp/bootstrap/cache/packages.php');
putenv('APP_SERVICES_CACHE_PATH=/tmp/bootstrap/cache/services.php');
putenv('APP_CONFIG_CACHE_PATH=/tmp/bootstrap/cache/config.php');
putenv('APP_ROUTES_CACHE_PATH=/tmp/bootstrap/cache/routes.php');

try {
    // Register Composer's autoloader
    require __DIR__ . '/../vendor/autoload.php';

    // Boot the native application matrix
    $app = require_once __DIR__ . '/../bootstrap/app.php';

    // Direct storage paths to the writable /tmp volume
    $app->useStoragePath('/tmp/storage');

    // ─── FAIL-SAFE RE-REGISTRATION FOR READ-ONLY RUNTIMES ───
    // If the provider system skips loading, force-register the base engines natively
    if (!$app->bound('events')) {
        $app->register(\Illuminate\Events\EventServiceProvider::class);
    }
    if (!$app->bound('view')) {
        $app->register(\Illuminate\View\ViewServiceProvider::class);
    }
    // ────────────────────────────────────────────────────────

    // Process the incoming request through the standard framework HTTP kernel
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

    $response = $kernel->handle(
        $request = Illuminate\Http\Request::capture()
    );

    $response->send();

    $kernel->terminate($request, $response);

} catch (\Throwable $e) {
    header('Content-Type: text/plain', true, 500);
    echo "=========================================\n";
    echo "   TRUE ROOTS CRASH IDENTIFIED           \n";
    echo "=========================================\n";
    echo "ERROR MESSAGE: " . $e->getMessage() . "\n\n";
    echo "FILE: " . $e->getFile() . "\n";
    echo "LINE: " . $e->getLine() . "\n\n";
    echo "STACK TRACE:\n" . $e->getTraceAsString() . "\n";
    exit(1);
}