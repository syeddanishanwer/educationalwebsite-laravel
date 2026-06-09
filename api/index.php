<?php

define('LARAVEL_START', microtime(true));

// Ensure required writable storage paths exist in /tmp
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

try {
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

} catch (\Throwable $e) {
    // Catch the absolute root error before Laravel handles it
    header('Content-Type: text/plain', true, 500);
    echo "=========================================\n";
    echo "   RAW SEVERLESS CRASH DETECTED         \n";
    echo "=========================================\n";
    echo "ERROR MESSAGE: " . $e->getMessage() . "\n\n";
    echo "FILE: " . $e->getFile() . "\n";
    echo "LINE: " . $e->getLine() . "\n\n";
    echo "STACK TRACE:\n" . $e->getTraceAsString() . "\n";
    exit(1);
}