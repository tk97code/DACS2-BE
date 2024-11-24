<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (!empty(Auth::user()->permission_id)) {
                // return $next($request);

                $path = $request->getPathInfo();

                $segments = explode('/', trim($path, '/'));

                $firstPrefix = $segments[0] ?? null;

                if (strtolower(Auth::user()->permission->permission_name) !== $firstPrefix) {
                    return abort(404);
                }
            } else {
                return redirect()->route('auth.permission.index');
            }
        } else {
            return redirect()->route('auth.index');
        }
        return $next($request);
    }
}
