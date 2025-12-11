<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsDosen;
use App\Http\Middleware\IsMahasiswa;
use App\Http\Middleware\OnlyMahasiswa;
use App\Http\Middleware\OnlyAdmin;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
        'admin' => IsAdmin::class,
        'dosen' => IsDosen::class,
        'mahasiswa' => IsMahasiswa::class,
        'mahasiswa.only' => OnlyMahasiswa::class,
        'admin.only' => OnlyAdmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
