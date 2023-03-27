<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRoles
{
    
    public function handle(Request $request, Closure $next, $roles): Response
    {
        $usuario = Auth::user();

            if (!$usuario->hasRole($roles)) {
                return response()->json([
                    'success' => false,
                    'message' => 'You do not have permission to access.',
                ], 403);
            }
        
        return $next($request);
    }
}
