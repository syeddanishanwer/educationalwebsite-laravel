<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Force path overrides for the Vercel read-only environment immediately on execution
if (env('VERCEL_JOB_ID') || env('NOW_REGION')) {
    $bootstrapCachePath = '/tmp/bootstrap/cache';
    if (!is_dir($bootstrapCachePath)) {
        mkdir($bootstrapCachePath, 0755, true);
    }
    
    $_ENV['APP_PACKAGES_CACHE_PATH'] = $bootstrapCachePath . '/packages.php';
    $_ENV['APP_SERVICES_CACHE_PATH'] = $bootstrapCachePath . '/services.php';
    $_ENV['APP_CONFIG_CACHE_PATH'] = $bootstrapCachePath . '/config.php';
    $_ENV['APP_ROUTES_CACHE_PATH'] = $bootstrapCachePath . '/routes.php';
}

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Intercept and print the TRUE underlying crash natively
        $exceptions->respond(function ($response, \Throwable $e) {
            header('Content-Type: text/plain', true, 500);
            echo "=========================================\n";
            echo "   TRUE UNDERLYING CRASH CAPTURED        \n";
            echo "=========================================\n";
            echo "REAL ERROR MESSAGE: " . $e->getMessage() . "\n\n";
            echo "FILE CAUSING CRASH: " . $e->getFile() . "\n";
            echo "LINE NUMBER: " . $e->getLine() . "\n\n";
            echo "STACK TRACE:\n" . $e->getTraceAsString() . "\n";
            exit(1);
        });
    })->create();