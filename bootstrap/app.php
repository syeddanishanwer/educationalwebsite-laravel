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
       // Force Laravel to use your exact custom route name for unauthenticated blocks
    $middleware->redirectGuestsTo(fn () => route('loginpage'));
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();