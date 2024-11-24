<?php

namespace App\Http\Middleware;

use App\Models\ClassDetailModel;
use App\Models\ClassModel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ClassPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $classId = $request->route('class'); // Lấy ID lớp từ route
        $userId = Auth::id(); // Lấy ID người dùng đã đăng nhập

        // Kiểm tra xem người dùng có thuộc lớp này không
        $isMember = ClassDetailModel::where('class_id', $classId)
                             ->where('id', $userId)
                             ->exists();
        $isCreator = ClassModel::where('class_id', $classId)->where('creator_id', $userId)->exists();

        if (!$isMember && !$isCreator) {
            // Trả về lỗi 403 hoặc chuyển hướng
            abort(403, 'Bạn không có quyền truy cập lớp này.');
        }

        return $next($request);

    }
}
