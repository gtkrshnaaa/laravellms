<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\SysAdminAuth;
use App\Http\Middleware\CourseAdminAuth;
use App\Http\Middleware\StudentAuth;
use App\Http\Middleware\LecturerAuth;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'sysadmin' => SysAdminAuth::class,
            'courseadmin' => CourseAdminAuth::class,
            'student' => StudentAuth::class,
            'lecturer' => LecturerAuth::class,
        ]);

        $middleware->validateCsrfTokens(except: [
            // ...
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();