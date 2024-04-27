<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductAccessMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $validToken = env('API_TOKEN');

        $token = $request->header('Authorization');
        if (!$token) {
            return response()->json(['error' => 'Token is missing'], 401);
        }

        if ($token !== $validToken) {
            return response()->json(['error' => 'Token is invalid.'], 401);
        }
            return $next($request);
    }
}
