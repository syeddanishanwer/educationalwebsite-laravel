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
        // Standard production exception handling continues here cleanly
    })->create();