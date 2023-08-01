<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IsAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check() &&  auth()->user()->is_admin)
            return $next($request);

        return response()->json(['message' => 'Unauthorized'],Response::HTTP_UNAUTHORIZED);
    }
}
