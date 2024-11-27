<?php

namespace App\Http\Middleware;

use App\Models\ClassDetailModel;
use App\Models\TestDeliveryModel;
use App\Models\TestDetailModel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TestPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $test_id = $request->route('test'); // Lấy ID lớp từ route
        $userId = Auth::id(); // Lấy ID người dùng đã đăng nhập

        if (!TestDeliveryModel::canAccessTest($test_id, $userId)) {
            abort(403, 'You do not have permission to access this test.');
        }

        return $next($request);
    }
}
