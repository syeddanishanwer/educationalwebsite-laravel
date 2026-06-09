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

$app->useStoragePath('/tmp/storage');

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Illuminate\Http\Request::capture();
$response = $kernel->handle($request);

// Force show response content regardless of status
header('Content-Type: text/plain');
http_response_code(200);
echo "STATUS: " . $response->getStatusCode() . "\n\n";
echo "CONTENT:\n";
echo $response->getContent();

$kernel->terminate($request, $response);