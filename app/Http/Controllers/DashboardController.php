<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $total_class = Auth::user()->class->count();
        $classes = ClassModel::where('creator_id', Auth::id())->get();
        return view('dashboard.teacher.main', compact('total_class', 'classes'));
    }
}
