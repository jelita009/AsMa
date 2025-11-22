<?php
namespace App\Http;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
class Kernel extends HttpKernel
{
    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        // ...
'admin' => \App\Http\Middleware\IsAdmin::class,
'dosen' => \App\Http\Middleware\IsDosen::class,
'mahasiswa' => \App\Http\Middleware\IsMahasiswa::class,
'mahasiswa.only' => \App\Http\Middleware\OnlyMahasiswa::class,
'admin.only' => \App\Http\Middleware\OnlyAdmin::class,
    ];
}