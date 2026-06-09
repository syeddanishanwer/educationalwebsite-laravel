<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

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
        // Intercept global exceptions on Vercel to extract the true underlying boot failure
        if (env('VERCEL_JOB_ID') || env('NOW_REGION')) {
            $exceptions->render(function (\Throwable $e) {
                header('Content-Type: text/plain', true, 500);
                echo "=========================================\n";
                echo "   CRITICAL CORE BOOT EXCEPTION REVEALED \n";
                echo "=========================================\n";
                echo "TRUE ERROR: " . $e->getMessage() . "\n";
                echo "FILE: " . $e->getFile() . "\n";
                echo "LINE: " . $e->getLine() . "\n\n";
                echo "STACK TRACE:\n" . $e->getTraceAsString() . "\n";
                exit(1);
            });
        }
    })->create();