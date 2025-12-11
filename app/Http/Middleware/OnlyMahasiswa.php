<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OnlyMahasiswa
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->guard('mahasiswa')->check()) {
            return $next($request);
        }

        abort(403, 'Hanya mahasiswa yg dapat mengisi aspirasi.');
    }
}
