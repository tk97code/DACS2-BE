<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function index() {
        return view('auth.auth');
    }

    public function permissionIndex() {
        if (!empty(Auth::user()->permission_id)) {
            return redirect()->route('teacher.dashboard.index');
        } else {
            if (!empty(Auth::user())) {
                return view('auth.permission');
            } else {
                return redirect()->route('auth.index');
            }
        }
    }

    public function handlelogin() {
        $data = request()->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($data)) {
            request()->session()->regenerate();

            if (Auth::user()->permission_id !== 1) {
                return redirect()->intended(route('teacher.dashboard.index'));
            }
            return redirect()->intended(route('student.dashboard.index'));
        } else {
            return back()->withErrors([
                'email' => 'Thông tin đăng nhập không chính xác.',
            ]);
        }
    }

    public function handleRegister() {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'permission_id' => 'required'
        ]);

        // Tạo người dùng mới
        $user = User::query()->create($data);

        request()->session()->regenerate();

        return redirect()->route('auth.index');
    }

    public function handleLogout() {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerate();

        return redirect()->route('home.index');
    }

    public function handlePermission() {
        if (request()->input('action') === 'logout') {
            return $this->handleLogout();
        } else { 
            $user = User::where('id', Auth::user()->id)->first();
            $user->permission_id = request()->input('permission_id');
            $user->save();

            Auth::setUser($user);
            if (strtolower(Auth::user()->permission->permission_name) === 'teacher') {
                return redirect()->intended(route('teacher.dashboard.index'));
            }
            return redirect()->intended(route('student.dashboard.index'));
        }
    }
}

