<?php

namespace App\Http\Controllers;

use App\Http\Middleware\ClassPermissionMiddleware;
use App\Models\ClassDetailModel;
use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class TeacherClassController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return [
            new Middleware(ClassPermissionMiddleware::class, only: ['show', 'edit', 'update', 'create', 'destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $total_class = Auth::user()->class->count();
        $classes = ClassModel::where('creator_id', Auth::id())->get();
        return view('dashboard.teacher.class.index', compact('total_class', 'classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'class_name' => 'required'
        ]);
        $data = request()->all();
        $data['invite_code'] = Uuid::uuid4()->toString();
        ClassModel::query()->create($data);

        $new_class = ClassModel::where('creator_id', Auth::id())->where('invite_code', $data['invite_code'])->get();
        return response(['current_total_class' => Auth::user()->class->count(), 'new_class' => $new_class]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $class_detail = ClassModel::where('class_id', $id)->first();

        $students = ClassDetailModel::where('class_id', $id)
        ->join('users', 'class_detail.id', '=', 'users.id') // Kết hợp với bảng users để lấy thông tin chi tiết học sinh
        ->select('users.id', 'users.name', 'users.email', 'users.gender', 'users.dob', 'users.avatar') // Chọn các cột cần thiết
        ->get();

        return view('dashboard.teacher.class.show', compact('id', 'class_detail', 'students'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
