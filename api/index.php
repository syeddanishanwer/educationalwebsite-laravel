<?php

// Fixes for Vercel serverless environment
define('LARAVEL_START', microtime(true));

// Fix working directory - critical for Vercel
chdir(__DIR__ . '/../');

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
)->send();

$kernel->terminate($request, $response);