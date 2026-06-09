<?php

define('LARAVEL_START', microtime(true));

// Critical: set correct working directory for Vercel
chdir(__DIR__ . '/../');

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

// Fix paths for serverless
$app->useBasePath(__DIR__ . '/../');
$app->usePublicPath(__DIR__ . '/../public');

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
)->send();

$kernel->terminate($request, $response);