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
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'auth.custom' => \App\Http\Middleware\AuthMiddleware::class,
            'role' => \App\Http\Middleware\RoleMiddleware::class,
            'guest.custom' => \App\Http\Middleware\GuestMiddleware::class,
            'track.visitor' => \App\Http\Middleware\TrackVisitorMiddleware::class,
        ]);

        // TinyMCE mengirim upload gambar via XHR mentah tanpa header CSRF.
        // Endpoint ini tetap terkunci di belakang middleware auth.custom + role:operator.
        $middleware->validateCsrfTokens(except: [
            'operator/tinymce/upload',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
