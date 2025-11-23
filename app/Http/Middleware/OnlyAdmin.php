<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OnlyAdmin
{

    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->guard('admin')->check()) {
            return $next($request);
        }
        
        abort(403, 'Hanya admin yg dapat menghapus aspiarsi.');
    }
}
